<?php

namespace Sibas\Entities\Td;

use Illuminate\Database\Eloquent\Model;
use Sibas\Entities\RetailerProductCategory;

class Detail extends Model {

    protected $table = 'op_td_details';
    /**/
    public $incrementing = false;
    
    public function category() {
        return $this->belongsTo(RetailerProductCategory::class, 'ad_retailer_product_category_id', 'id');
    }

    public function header() {
        return $this->belongsTo(Header::class, 'op_td_header_id', 'id');
    }

    public function facultative() {
        return $this->hasOne(Facultative::class, 'op_td_detail_id', 'id');
    }
    /**/
}
