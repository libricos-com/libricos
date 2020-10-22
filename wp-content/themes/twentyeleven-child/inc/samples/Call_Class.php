<?php
/**
 * Undocumented class
 * @see https://carlalexander.ca/static-factory-method-pattern-wordpress/
 */
class MyPlugin_Call_Class
{
    function __call($name, $arguments)
    {
        if ('do_something' == $name && 1 == count($arguments)) {
            // ...
        } elseif ('do_something' == $name && 2 == count($arguments)) {
            // ...
        }
    }
}
 
$some_class = new MyPlugin_Call_Class();
$some_class->do_something($argument1);
$some_class->do_something($argument1, $argument2);

class MyPlugin_SomeClass
{
    public function do_something()
    {
        $arguments = func_get_args();
 
        if (1 == count($arguments)) {
            // ...
        } elseif (2 == count($arguments)) {
            // ...
        }
    }
}
 
$some_class = new MyPlugin_SomeClass();
$some_class->do_something($argument1);
$some_class->do_something($argument2, $argument3);