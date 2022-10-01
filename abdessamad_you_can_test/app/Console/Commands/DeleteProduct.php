<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\IProductRepository;

class DeleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:delete
                            {--id= : id of the product }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a product';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(IProductRepository $productRepository)
    {
        $id = $this->option('id');
        $productRepository->deleteProduct($id);

        $this->info('Product deleted successfully');
    }
}
