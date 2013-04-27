<?php namespace Orchestra\Widget\Drivers;

use ArrayAccess;
use InvalidArgumentException;
use Illuminate\Support\Facades\Config;
use Orchestra\Widget\Nesty;

abstract class Driver implements ArrayAccess {

	/**
	 * Application instance.
	 *
	 * @var Illuminate\Foundation\Application
	 */
	protected $app = null;

	/**
	 * Nesty instance
	 *
	 * @var Orchestra\Widget\Nesty
	 */
	protected $nesty = null;

	/**
	 * Name of this instance.
	 *
	 * @var string
	 */
	protected $name = null;

	/**
	 * Widget Configuration.
	 *
	 * @var array
	 */
	protected $config = array();

	/**
	 * Type of Widget.
	 *
	 * @var string
	 */
	protected $type = null;

	/**
	 * Construct a new instance
	 *
	 * @access  public
	 * @param   Illuminate\Foundation\Application   $app
	 * @param   string                              $name
	 * @return  void
	 */
	public function __construct($app, $name)
	{
		$this->app    = $app;
		$this->config = array_merge(
			Config::get("orchestra/widget::{$this->type}.{$name}", array()), 
			$this->config
		);

		$this->name   = $name;
		$this->nesty  = new Nesty($this->config);
	}

	/**
	 * Add an item to current widget.
	 *
	 * @access public
	 * @param  string   $id
	 * @param  mixed    $location
	 * @param  Closure  $callback
	 * @return mixed
	 */
	public abstract function add($id, $location = 'parent', $callback = null);

	/**
	 * Get all item from Nesty.
	 *
	 * @access public
	 * @return array
	 * @see    Orchestra\Widget\Nesty::getItem()
	 */
	public function getItems()
	{
		return $this->nesty->getItems();
	}

	/**
	 * Magic method to get all items
	 *
	 * @param  string   $key
	 * @return mixed
	 * @throws InvalidArgumentException
	 */
	public function __get($key)
	{
		if ($key !== 'items') 
		{
			throw new InvalidArgumentException("Access to [{$key}] is not allowed.");
		}

		return $this->getItems();
	}

	/**
	 * Determine if the given attribute exists.
	 *
	 * @param  mixed  $key
	 * @return bool
	 */
	public function offsetExists($key)
	{
		$items = $this->getItems();
		return isset($items[$key]);
	}

	/**
	 * Get the value for a given offset.
	 *
	 * @param  mixed  $key
	 * @return mixed
	 */
	public function offsetGet($key)
	{
		$items = $this->getItems();
		return $items[$key];
	}

	/**
	 * Set the value for a given offset.
	 *
	 * @param  mixed  $key
	 * @param  mixed  $value
	 * @return void
	 */
	public function offsetSet($key, $value)
	{
		throw new RuntimeException("Unable to set [{$key}]");
	}

	/**
	 * Unset the value for a given offset.
	 *
	 * @param  mixed  $key
	 * @return void
	 */
	public function offsetUnset($key)
	{
		throw new RuntimeException("Unable to unset [{$key}]");
	}
}