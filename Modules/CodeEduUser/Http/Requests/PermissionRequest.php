<?php

namespace CodeEduUser\Http\Requests;

use CodeEduUser\Repositories\RoleRepository;
use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('role');
        
        return [
            'permissions.*' => 'exists:permissions,id'
        ];
    }




}
