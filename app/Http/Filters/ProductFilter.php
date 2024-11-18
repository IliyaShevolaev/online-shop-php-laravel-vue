<?php 

namespace App\Http\Filters;

use App\Http\Filters\Base\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    const TITLE = 'title';
    const PRICE = 'price';
    const CATEGORY_ID = 'category_id';
    const GENRES = 'genres';

    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::PRICE => [$this, 'price'],
            self::CATEGORY_ID => [$this, 'category_id'],
            self::GENRES => [$this, 'genres'],
        ];
    }

    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%");
    }

    public function price(Builder $builder, $value)
    {
        if ($value['from'] !== null) {
            $builder->where('price', '>=', $value['from']);
        }
    
        if ($value['to'] !== null) {
            $builder->where('price', '<=', $value['to']);
        }
    
        if ($value['from'] !== null && $value['to'] !== null) {
            $builder->whereBetween('price', [$value['from'], $value['to']]);
        }
    }

    public function category_id(Builder $builder, $value)
    {
        $builder->where('category_id', $value);
    }

    public function genres(Builder $builder, $value)
    {
        $builder->whereHas('genres', function (Builder $query) use ($value) {
            $query->whereIn('genre_id', $value);
        });
    }
}