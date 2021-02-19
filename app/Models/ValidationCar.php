<?php

namespace App\Models;

class ValidationCar {
    const RULE_TO_CREATE = [
        'name' => 'required | max:30',
        'description' => 'required',
        'model' => 'required | max:10 | min:2',
        'date' => 'required | date_format: "Y-m-d"'
    ];
    const RULE_TO_UPDATE = [
        'name' => 'max:30 | min:4',
        'model' => 'max:10 | min:2',
        'date' => 'date_format: "Y-m-d"'
    ];
}
