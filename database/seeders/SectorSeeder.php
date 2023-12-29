<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            [
                'value' => 1,
                'label' => 'Manufacturing',
                'children' => [
                    ['value' => 19, 'label' => 'Construction materials'],
                    ['value' => 18, 'label' => 'Electronics and Optics'],
                    [
                        'value' => 6,
                        'label' => 'Food and Beverage',
                        'children' => [
                            ['value' => 342, 'label' => 'Bakery & confectionery products'],
                            ['value' => 43, 'label' => 'Beverages'],
                            ['value' => 42, 'label' => 'Fish & fish products'],
                            ['value' => 40, 'label' => 'Meat & meat products'],
                            ['value' => 39, 'label' => 'Milk & dairy products'],
                            ['value' => 437, 'label' => 'Other'],
                            ['value' => 378, 'label' => 'Sweets & snack food'],
                        ],
                    ],
                    ['value' => 13, 'label' => 'Furniture'],
                    [
                        'value' => 12,
                        'label' => 'Machinery',
                        'children' => [
                            ['value' => 94, 'label' => 'Machinery components'],
                            ['value' => 91, 'label' => 'Machinery equipment/tools'],
                            ['value' => 224, 'label' => 'Manufacture of machinery'],
                            ['value' => 97, 'label' => 'Maritime'],
                            [
                                'value' => 271,
                                'label' => 'Aluminium and steel workboats',
                            ],
                            ['value' => 269, 'label' => 'Boat/Yacht building'],
                            ['value' => 230, 'label' => 'Ship repair and conversion'],
                        ],
                    ],
                    [
                        'value' => 11,
                        'label' => 'Metalworking',
                        'children' => [
                            ['value' => 67, 'label' => 'Construction of metal structures'],
                            ['value' => 263, 'label' => 'Houses and buildings'],
                            ['value' => 267, 'label' => 'Metal products'],
                            ['value' => 542, 'label' => 'Metal works'],
                            ['value' => 75, 'label' => 'CNC-machining'],
                            ['value' => 62, 'label' => 'Forgings, Fasteners'],
                            ['value' => 69, 'label' => 'Gas, Plasma, Laser cutting'],
                            ['value' => 66, 'label' => 'MIG, TIG, Aluminum welding'],
                        ],
                    ],
                    [
                        'value' => 9,
                        'label' => 'Plastic and Rubber',
                        'children' => [
                            ['value' => 54, 'label' => 'Packaging'],
                            ['value' => 556, 'label' => 'Plastic goods'],
                            ['value' => 559, 'label' => 'Plastic processing technology'],
                            ['value' => 55, 'label' => 'Blowing'],
                            ['value' => 57, 'label' => 'Moulding'],
                            ['value' => 53, 'label' => 'Plastics welding and processing'],
                            ['value' => 560, 'label' => 'Plastic profiles'],
                        ],
                    ],
                    [
                        'value' => 5,
                        'label' => 'Printing',
                        'children' => [
                            ['value' => 148, 'label' => 'Advertising'],
                            ['value' => 150, 'label' => 'Book/Periodicals printing'],
                            ['value' => 145, 'label' => 'Labelling and packaging printing'],
                        ],
                    ],
                    ['value' => 7, 'label' => 'Textile and Clothing'],
                    ['value' => 8, 'label' => 'Wood'],
                ],
            ],
            [
                'value' => 2,
                'label' => 'Service',
                'children' => [
                    ['value' => 25, 'label' => 'Business services'],
                    ['value' => 35, 'label' => 'Engineering'],
                    [
                        'value' => 28,
                        'label' => 'Information Technology and Telecommunications',
                        'children' => [
                            ['value' => 581, 'label' => 'Data processing, Web portals, E-marketing'],
                            ['value' => 576, 'label' => 'Programming, Consultancy'],
                            ['value' => 121, 'label' => 'Software, Hardware'],
                            ['value' => 122, 'label' => 'Telecommunications'],
                        ],
                    ],
                    ['value' => 22, 'label' => 'Tourism'],
                    ['value' => 141, 'label' => 'Translation services'],
                    ['value' => 21, 'label' => 'Transport and Logistics'],
                ],
            ],
            [
                'value' => 3,
                'label' => 'Other',
                'children' => [
                    ['value' => 37, 'label' => 'Creative industries'],
                    ['value' => 29, 'label' => 'Energy technology'],
                    ['value' => 33, 'label' => 'Environment'],
                ],
            ],
        ];



        // Assuming $options holds the array structure you want to insert
        insertSectors($options);


    }
}
function insertSectors($options, $parentId = null) {
    foreach ($options as $option) {
        // Insert each element into the 'sectors' table
        DB::table('sectors')->insert([
            'id' => $option['value'],
            'parent_id' => $parentId,
            'name' => $option['label'],
            // Adjust other columns as needed based on your database table structure
        ]);

        // Check if the current option has children
        if (isset($option['children'])) {
            // Recursively call the function to insert children with the current option as parent
            insertSectors($option['children'], $option['value']);
        }
    }
}
