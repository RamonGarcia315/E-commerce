<?php

namespace App\Livewire\Admin\Products;

use App\Models\Feature;
use App\Models\Option;
use App\Models\Variant;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductVariants extends Component
{
    public $product;

    public $openModal = false;

    public $options;

    public $variant = [
        'option_id' => '',
        'features' => [
            [
                'id' => '',
                'value' => '',
                'description' => '',
            ],
        ]
    ];

    public function mount()
    {
        $this->options = Option::all();
    }

    public function updatedVariantOptionId()
    {
        $this->variant['features'] = [
                [
                    'id' => '',
                    'value' => '',
                    'description' => '',
                ],
            ];
    }

    #[Computed()]
    public function features()
    {
        return Feature::where('option_id', $this->variant['option_id'])->get();
    }

    public function rules()
    {
        $rules = [
            'variant.option_id' => 'required',
            'variant.features.*.id' => 'required',
        ];

        return $rules;
    }

    public function validationAttributes()
    {
        $attributes = [
            'variant.option_id' => 'Možnost',
            'variant.features.*.id' => 'Hodnoty',
        ];

        foreach ($this->variant['features'] as $index => $feature) {
            $attributes['variant.features.' . $index . '.id'] = 'Hodnota ' . ($index + 1);
        }

        return $attributes;
    }

    public function addFeature()
    {
        $this->variant['features'][] = [
            'id' => '',
            'value' => '',
            'description' => '',
        ];
    }

    public function feature_change($index)
    {
        $feature = Feature::find($this->variant['features'][$index]['id']);

        if ($feature) {
            $this->variant['features'][$index]['value'] = $feature->value;
            $this->variant['features'][$index]['description'] = $feature->description;
        }
    }

    public function removeFeature($index)
    {
        unset($this->variant['features'][$index]);
        $this->variant['features'] = array_values($this->variant['features']);
    }

    public function deleteFeature($option_id, $feature_id)
    {
        $this->product->options()->updateExistingPivot($option_id, [
            'features' => array_filter($this->product->options->find($option_id)->pivot->features, function($feature) use($feature_id){
                return $feature['id'] !=$feature_id;
            })
        ]);

        $this->product = $this->product->fresh();

        $this->generateVariants();
    }

    public function deleteOption($option_id) 
    {
        $this->product->options()->detach($option_id);
        $this->product = $this->product->fresh();
        $this->generateVariants();
    }

    public function save()
    {
        $this->validate();

        $this->product->options()->attach($this->variant['option_id'],[
            'features' => $this->variant['features']
        ]);

        $this->generateVariants();

        $this->reset(['variant', 'openModal']);
    }

    public function generateVariants()
    {
        $features = $this->product->options->pluck('pivot.features');

        $combinations = $this->generateCombinations($features);

        $this->product->variants()->delete();

        foreach ($combinations as $combination) {
            $variant = Variant::create([
                'product_id' => $this->product->id,
            ]);

            $variant->features()->attach($combination);
        }

        $this->dispatch('variant-generate');
    }

    function generateCombinations($arrays, $index = 0, $combination = [])
    {
        if ($index == count($arrays)) {
            return [$combination];
        }

        $result = [];

        foreach ($arrays[$index] as $item) {

            $temporaryCombination = $combination;
            $temporaryCombination[] = $item['id'];

            $result = array_merge($result, $this->generateCombinations($arrays, $index + 1, $temporaryCombination));
        }

        return $result;
    }

    public function render()
    {
        return view('livewire.admin.products.product-variants');
    }
}
