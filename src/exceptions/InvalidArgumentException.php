<?php
/**
 * Exeptions for every type to include them in project as local exeptions
 * @author Olga Zhilkova
 * @copyright 2017
 */

namespace factoryDB;

/**
 * Exception that is raised when invalid (scalar) arguments
 * are passed to a method.
 *
 * @package    Money
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.github.com/sebastianbergmann/money
 */
class InvalidArgumentException extends \InvalidArgumentException implements Throwable
{
}
