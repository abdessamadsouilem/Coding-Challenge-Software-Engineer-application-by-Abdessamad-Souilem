<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\ICategoryRepository;

class DeleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:delete
                            {--id= : id of the category }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a category';

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
    public function handle(ICategoryRepository $categoryRepository)
    {
        $id = $this->option('id');
        $categoryRepository->deleteCategory($id);

        $this->info('Category deleted successfully');
    }

}
