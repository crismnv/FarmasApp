<?php namespace App;

use Esensi\Model\Contracts\ValidatingModelInterface;
use Esensi\Model\Traits\ValidatingModelTrait;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole implements ValidatingModelInterface
{
  use ValidatingModelTrait;

  protected $throwValidationExceptions = true;

  protected $fillable = [
    'name',
    'display_name',
    'description',
  ];

  protected $rules = [
    'name'      => 'required|unique:roles',
    'display_name'      => 'required|unique:roles',
  ];

  // public static function obtenerId_x_rol($rol)
  // {

  //   return Role::select("roles.id as id")->where("name", '=', $rol)->get();
  // }
}
