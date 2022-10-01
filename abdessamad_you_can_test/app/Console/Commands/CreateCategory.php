<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\ICategoryRepository;
use Illuminate\Support\Facades\Validator;

class CreateCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:create
                            {--name= : name of the category }
                            {--parent= : parent of the category}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new category';

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
        $category = collect($this->options())->only(['name', 'parent'])->all();
        if (!$this->validate($category)) {
            return 1;
        }
        // convert category to object
        $category = (object) $category;
        $categoryRepository->createCategory($category);
        $this->info('Category created successfully');
    }

    private function validate($category)
    {
        $validator = Validator::make($category, [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            $this->error($validator->errors()->first());
            return false;
        }
        return true;
    }
}
