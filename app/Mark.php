<?php

namespace App;

use App\Model;

class Mark extends Model
{
    
    protected
    	$table = 'marks',
    	$fillable = [
			'id',
			'name',
			'title',
			'description',
		],
		$rules = [
			'name' => 'required|unique:marks',
            // 'title' => 'email',
            // 'description' => 'required',
		],
		$searchable = [
            'columns' => [
                'title' => 10,
                'description' => 10,
                'name' => 9,
            ]
        ];



}
