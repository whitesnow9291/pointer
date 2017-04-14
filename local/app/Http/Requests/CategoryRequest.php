<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CategoryRequest extends Request {

    /**
     * The URI to redirect to if validation fails.
     *
     * @var string
     */
    protected $redirect;
    
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
	    $record = $this->get('data');
	    $id = isset($record['id']) ? $record['id'] : 0;
	    
		return [
			'data.category_name'  => 'required|unique:category,category_name' . ($id > 0 ? ",{$id}" : ''),   
		];
	}
	
	/**
	 * Set custom messages for validator errors.
	 *
	 * @return array
	 */
	public function messages()
	{
	    return [];
	}
	
	/**
	 * Set custom attributes for validator errors.
	 *
	 * @return array
	 */
	public function attributes()
	{
	    return [
	        'data.category_name' => 'カテゴリ', 
	    ];
	}

}
