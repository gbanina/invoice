<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function getBillingDate()
    {
      return date("d.m.Y.", strtotime ($this->billing_date));
    }

    public function getIssueDate()
    {
      return date("d.m.Y.", strtotime ($this->issue_date));
    }

    public function getNumberHuman()
    {
      return $this->number . '/1/1';
    }
}
