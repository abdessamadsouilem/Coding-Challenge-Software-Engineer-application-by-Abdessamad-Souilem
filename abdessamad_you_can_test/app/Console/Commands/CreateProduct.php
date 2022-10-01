<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\IProductRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create
                            {--name= : name of the product }
                            {--description= : description of the product}
                            {--price= : price of the product}
                            {--category_id= : category_id of the product}
                            {--image= : image path  }';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new product';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    // handle method 
    public function handle(IProductRepository $productRepository)
    {
        
        // get the options
        $product = collect($this->options())->only(['name', 'description', 'price', 'category_id', 'image'])->all(); 
        // validate the options
        if (!$this->validate($product)) {
            return 1;
        }

        // upload image
        if($this->option('image')){
            $image = $this->option('image');
            $image_name = File::basename($image);
            File::copy($image, public_path('/images/'.$image_name));
            $image_path = "/images/" . $image_name;
            $product['image'] = $image_name;
        }

        // convert product to object
        $product = (object) $product;

        // create the product
        $productRepository->createProduct($product);

        $this->info('Product created successfully');
    }

    // validate method
    protected function validate($product)
    {
        $validator = Validator::make($product, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            $this->error($validator->errors()->first());
            return false;
        }

        return true;
    }



    
}
