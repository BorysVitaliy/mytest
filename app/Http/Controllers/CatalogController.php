<?php

namespace MyApp\Http\Controllers;

use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use MyApp\Entity\Category;
use MyApp\Entity\City;
use MyApp\Entity\Product;
use MyApp\Http\Resources\ProductCollection;

class CatalogController extends Controller
{
    public function index(Request $request, string $slug = null): Resource
    {

        //Если категории не существует, выкидываем ошибку
        $category = Category::where('slug', $slug)->firstOrFail();

        //Создаем builder на извлечение моделей товаром,
        //Так же загружаем сразу модель выбраной категории
        $builder = Product::category($slug)->with(['categories' => function ($with) use ($category) {
            $with->where('categories.id', $category->id);
        }
        ]);


        //Если есть фильтр по городу, то сначала проверим сеществует ли такой город
        //В противном случае выкидывем ошибку
        //В положительном случае загружаем связанною модель города

        if ($request->has('city')) {

            $city = City::where('slug', $request->city)->firstOrFail();

            $builder->with(['cities' => function ($with) use ($request) {

                // Берем только один (выбранный город)
                if ($request->has('city')) {
                    $with->where('slug', $request->city);
                }

            }])->city($city->getID());

            if($request->has('sort')){

                $sort = explode("_",$request->sort);

                $sort_modificator = (isset($sort[1]) && in_array($sort[1],['asc','desc'])) ? $sort[1] :  'asc';


                $builder->orderBy('price',$sort_modificator);
            }else{
                $builder->orderBy('title','ASC');
            }
        }

        return new ProductCollection($builder->get());

    }
}
