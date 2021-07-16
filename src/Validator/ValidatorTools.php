<?php


namespace CCTools\Validator;


use Illuminate\Support\Facades\Validator;

class ValidatorTools
{
    protected $rules;
    protected $messages;
    protected $scenes;
    private $oldRules;


    private $validator;

    public function __construct()
    {
        $this->scan();
    }

    /**
     *  表单数据
     * @param $input
     *  场景
     * @param $scenes
     * @return boolean
     */

    public function validator($input,$scenes = '')
    {
        $scenes ? $this->getScenes($scenes) : ($this->rules = $this->oldRules);
        $this->setValidator(Validator::make($input, $this->rules, $this->messages));
        return !$this->validator->fails();
    }

    /**
     * 获取场景值对应的验证
     * @param $scenes
     */
    public function getScenes($scenes) {
        if(is_array($this->scenes) && isset($this->scenes[$scenes])) {
            $this->setRules($this->scenes[$scenes]);
        }else{
            # 抛出异常
            // throw new \Exception('Something went wrong. Time for lunch!');
        }
    }

    /**
     * 根据传入的规则名数组，保留规定的验证规则
     * @param $rules
     */
    public function setRules($rules) {
        $this->oldRules = $this->rules;

        foreach ($this->rules as $key => $rule) {
            if(!in_array($key, $rules)) {
                if(!in_array($key, $rules) &&  isset($rules[$key]) && is_array($rules[$key])) {
                    $this->rules[$key] = $rules[$key][0];
                }else{
                    unset($this->rules[$key]);
                }
            }
        }
        //$this->rules    = array_only($this->rules, $rules);
    }

    /**
     * 设置验证器对象
     * @param $validator
     */
    public function setValidator($validator) {
        $this->validator = $validator;
    }

    /**
     * 获取验证器对象
     * @return \App\Http\Validator\Validator
     */
    public function getValidator() {
        return $this->validator;
    }

    /**
     * 获取错误信息
     * @return array
     */
    public function getErrorMessages() {
        return $this->validator->errors()->getMessages();
    }

    /**
     *获取一条错误信息
     * @return string
     */
    public function getErrorFirst()
    {
        return $this->validator->errors()->first();
    }

    /**
     * 魔术方法，未匹配到的方法直接引用验证器自身的
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if(method_exists($this->validator, $name)) {
            return call_user_func_array([$this->validator, $name], $arguments);
        }else{
            // throw new \Exception('Something went wrong. Time for lunch!');
        }
    }

    /**
     * 通过反射，注册验证方法
     * @var $className
     */
    public function scan() {
        try{
            $classInfo = new ReflectionClass(get_class($this));
            $classNameSpace = $classInfo->getName();
            foreach ($classInfo->getMethods() as $method) {
                if($classNameSpace == $method->class && $method->name != '__construct') {
                    # 如果是子类的方法
                    Validator::extend($method->name, $classNameSpace.'@'.$method->name);
                }
            }
        }catch (\ReflectionException $exception) {
            //
        }
    }
}