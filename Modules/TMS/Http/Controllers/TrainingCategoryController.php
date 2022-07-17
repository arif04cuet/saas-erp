<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TMS\Entities\Training;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\TrainingCategory;
use Modules\TMS\Services\TrainingCategoryService;
use Modules\TMS\Http\Requests\TrainingCategoryRequest;
use Modules\TMS\Http\Requests\StoreUpdateTrainingCategoryRequest;

class TrainingCategoryController extends Controller
{
    /**
     * @var
     */
    private $trainingCategoryService;

    public function __construct(
        TrainingCategoryService $trainingCategoryService
    ) {
        $this->trainingCategoryService = $trainingCategoryService;
    }

    /**
     *
     */
    public function index(TrainingCategory $trainingCategory)
    {
        $categoriesDropdown = $this->getTrainingCategoryForDropdown();

        $categories = $this->trainingCategoryService->findAll(
            null,
            null,
            ['column' => 'created_at', 'direction' => 'asc']
        );

        return view('tms::training.category.category-entry', compact('trainingCategory', 'categories', 'categoriesDropdown'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('tms::create');
    }

    /**
     * @param Request $request
     */
    public function store(TrainingCategoryRequest $request)
    {
        if ($this->trainingCategoryService->store($request->all())) {
            return redirect()->route('training.category.index')->with('success', trans('labels.save_success'));
        } else {
            return redirect()->route('training.category.index')->with(
                'error',
                trans('labels.save_fail')
            );
        }
    }

    /**
     * @param Training $training
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Training $training)
    {
        $trainingCategories = $this->trainingCategoryService->formattedCategories();

        return view(
            'tms::training.category.show',
            compact(
                'trainingCategories',
                'training'
            )
        );
    }
    /**
     * @param TrainingCategory $trainingCategory
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTrainingCategory($trainingCategory)
    {
        $trainingCategory = TrainingCategory::findOrFail($trainingCategory);

        return view('tms::training.category.show-category', compact('trainingCategory'));
    }

    /**
     * @param Training $training
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Training $training)
    {
        $trainingCategories = $this->trainingCategoryService->formattedCategories();

        return view(
            'tms::training.category.edit',
            compact(
                'trainingCategories',
                'training'
            )
        );
    }

    /**
     * @param TrainingCategory $trainingCategory
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categoryEdit($trainingCategory)
    {
        $trainingCategory = TrainingCategory::findOrFail($trainingCategory);
        $categoriesDropdown = $this->getTrainingCategoryForDropdown();

        return view('tms::training.category.category-edit', compact('trainingCategory', 'categoriesDropdown'));
    }

    /**
     * @param StoreUpdateTrainingCategoryRequest $storeUpdateTrainingCategoryRequest
     * @param Training $training
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(
        StoreUpdateTrainingCategoryRequest $storeUpdateTrainingCategoryRequest,
        Training $training
    ) {
        $update = $this->trainingCategoryService->updateTrainingCategory(
            $storeUpdateTrainingCategoryRequest->all(),
            $training
        );

        if ($update) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('training.category.show', ['training' => $training]);
    }

    /**
     * Update the specified resource in storage.
     * @param TrainingCategoryRequest $request
     * @param TrainingCategory $trainingCategory
     * @return RedirectResponse
     */
    public function categoryUpdate(TrainingCategoryRequest $request, $trainingCategory)
    {
        $trainingCategory = TrainingCategory::findOrFail($trainingCategory);
        // dd($trainingCategory);
        if ($this->trainingCategoryService->updateData($request->all(), $trainingCategory)) {
            return redirect()->route('training.category.index')->with('success', trans('labels.update_success'));
        } else {
            return redirect()->route('training.category.index')->with(
                'error',
                trans('labels.update_fail')
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param TrainingCategory $trainingCateogry
     * @return void
     */
    public function destroy($trainingCategory)
    {
        $response = $this->trainingCategoryService->destroy($trainingCategory);
        Session::flash('message', $response->getContent());
        return redirect('/tms/training/category');
    }

    //TODO: move this method into TrainingCategoryService
    private function formatCategory(TrainingCategory $category, $level = 0)
    {

        $this->trainingCategories[] = [
            'id' => $category->id,
            'slug' => $category->slug,
            'level' => $level,
            'parent' => Arr::get($category->parent, 'slug', '')
        ];

        $category->children->each(function ($child) use ($level) {
            $this->formatCategory($child, $level + 1);
        });
    }

    public function getTrainingCategoryForDropdown()
    {
        // $training_category = !App::isLocale('bn') ? 'name_english' : 'name_bangla';
        // return $this->findAll()->pluck($training_category, 'id');
        if (app()->getLocale() == 'bn') {
            $categories = TrainingCategory::all()->pluck('name_bangla', 'id');
        } else {
            $categories = TrainingCategory::all()->pluck('name_english', 'id');
        }

        return $categories;
    }
}
