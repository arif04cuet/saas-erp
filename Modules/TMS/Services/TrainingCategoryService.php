<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 9/30/19
 * Time: 7:34 PM
 */

namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\Training;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Modules\TMS\Entities\TrainingCategory;
use SebastianBergmann\RecursionContext\Exception;
use Modules\TMS\Repositories\TrainingCategoryRepository;

class TrainingCategoryService
{
    use CrudTrait;
    /**
     * @var TrainingCategoryRepository
     */
    private $trainingCategoryRepository;

    /**
     * @var
     */
    private $trainingCategories;

    /**
     * TrainingCategoryService constructor.
     * @param TrainingCategoryRepository $trainingCategoryRepository
     */
    public function __construct(
        TrainingCategoryRepository $trainingCategoryRepository
    )
    {
        $this->trainingCategoryRepository = $trainingCategoryRepository;
        $this->setActionRepository($trainingCategoryRepository);

        $this->trainingCategories = [];
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $trainingTypeData = $this->getTrainingTypeData($data);
            $trainingType = $this->save($trainingTypeData);
            DB::commit();
            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Training Category Creation Error ' . $exception->getMessage() . ' Trace:' . $exception->getTraceAsString());
            return false;
        }
    }

    public function updateData(array $data, TrainingCategory $trainingType)
    {
        try {
            DB::beginTransaction();
            $trainingTypeData = $this->getTrainingTypeData($data);
            $trainingType = $this->update($trainingType, $trainingTypeData);
            DB::commit();
            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Training Type Creation Error ' . $exception->getMessage() . ' Trace:' . $exception->getTraceAsString());
            return false;
        }

    }

    //------------------------------------------------------------------------------------------
    //                                      Private Function
    //-------------------------------------------------------------------------------------------

    private function getTrainingTypeData(array $data)
    {
        if(!isset($data['parent_id'])){
            $parent_id = '';
        }else{
            $parent_id = $data['parent_id'];
        }

        $slug = Str::slug($data['name_english']);
        
        return [
            'name_english' => $data['name_english'],
            'name_bangla' => $data['name_bangla'],
            'parent_id' => $parent_id,
            'slug' => $slug,
        ];
    }

    public function formattedCategories()
    {
        $this->trainingCategoryRepository->findBy([
            'parent_id' => 0
        ])->each(function ($category) {
            $this->format($category);
        });

        return $this->trainingCategories;
    }

    public function updateTrainingCategory($data, Training $training)
    {
        return DB::transaction(function() use ($data, $training) {
            return $training->update(['category_id' => $data['category_id']]);
        });
    }

    public function leaves()
    {
        return $this->trainingCategoryRepository->findAll()
            ->filter(function ($category) {
                return $category->children->count() === 0;
            });
    }

    private function format(TrainingCategory $trainingCategory, $level = 0)
    {
        $this->trainingCategories[] = [
            'id' => $trainingCategory->id,
            'slug' => $trainingCategory->getName(),
            'tai' => $trainingCategory->slug,
            'level' => $level,
            'parent' => $trainingCategory->getParent()
        ];

        $trainingCategory->children->each(function($child) use ($level){
           $this->format($child, $level+1);
        });

        // $this->trainingCategories[] = [
        //     'id' => $trainingCategory->id,
        //     'slug' => $trainingCategory->slug,
        //     'level' => $level,
        //     'parent' => Arr::get($trainingCategory->parent, 'slug', '')
        // ];

        // $trainingCategory->children->each(function($child) use ($level){
        //    $this->format($child, $level+1);
        // });
    }

    public function destroy($id)
    {
        $trainingType = $this->findOrFail($id);
        DB::transaction(function () use ($trainingType) {
            $trainingType->delete();
        });

        return new Response("Training Category has been deleted successfully");
    }
}
