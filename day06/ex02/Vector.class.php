<?PHP
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   Vector.class.php                                   :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: dthan <dthan@student.42.fr>                +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2020/06/22 06:24:32 by dthan             #+#    #+#             */
/*   Updated: 2020/06/22 06:24:32 by dthan            ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

require_once 'Vertex.class.php';

Class Vector {
	private $_x;
	private $_y;
	private $_z;
	private $_w = 0.0;
	static $verbose = false;

	public function __construct( $array ) {
		if ( array_key_exists( 'dest', $array ) && $array['dest'] instanceof Vertex ) {
			if ( array_key_exists( 'orig', $array ) && $array['orig'] instanceof Vertex) {
				$this->_x = $array['dest']->_x - $array['orig']->_x;
				$this->_y = $array['dest']->_y - $array['orig']->_y;
				$this->_z = $array['dest']->_z - $array['orig']->_z;
				$this->_w = $array['dest']->_w - $array['orig']->_w;
			} else {
				$dest = new Vertex(array ('x' => 0, 'y' => 0, 'z' => 0, 'w' => 1));
				$this->_x = $array['dest']->_x - $dest->_x;
				$this->_y = $array['dest']->_y - $dest->_y;
				$this->_z = $array['dest']->_z - $dest->_z;
				$this->_w = $array['dest']->_w - $dest->_w;
			}
		}
		if (self::$verbose)
			echo $this->__toString() . " constructed" . PHP_EOL;
	}

	public function __destruct() {
		if (self::$verbose)
			echo $this->__toString() . " destructed" . PHP_EOL;
		return ;
	}

	public function __toString() {
		return sprintf( "Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f )", $this->_x, $this->_y, $this->_z , $this->_w );
	}

	public static function doc() {
		if ( $str = file_get_contents( 'Vector.doc.txt' ) )
			echo $str;
		else
			echo "Error: .doc file doesn't exist." . PHP_EOL;
	}

	public function magnitude() {
		return (float)sqrt(pow($this->_x, 2) + pow($this->_y, 2) + pow($this->_z, 2));
	}

	public function normalize() {
		$magnitude = $this->magnitude();
		if ($magnitude == 1)
			return clone $this;
		return new Vector ( array('dest' => new Vertex(array( 'x'=>$this->_x/$magnitude, 'y'=>$this->_y/$magnitude, 'z'=>$this->_z/$magnitude ))));
	}

	public function add( Vector $rhs ) {
		return new Vector ( array('dest' => new Vertex(array( 'x'=>$this->_x+$rhs->_x, 'y'=>$this->_y+$rhs->_y, 'z'=>$this->_z+$rhs->_z ))));
	}

	public function sub( Vector $rhs ) {
		return new Vector ( array('dest' => new Vertex(array( 'x'=>$this->_x-$rhs->_x, 'y'=>$this->_y-$rhs->_y, 'z'=>$this->_z-$rhs->_z ))));
	}

	public function opposite() {
		return new Vector ( array('dest' => new Vertex(array( 'x'=>$this->_x*-1, 'y'=>$this->_y*-1, 'z'=>$this->_z*-1 ))));
	}

	public function scalarProduct($k) {
		return new Vector ( array('dest' => new Vertex(array( 'x'=>$this->_x*$k, 'y'=>$this->_y*$k, 'z'=>$this->_z*$k ))));
	}

	public function dotProduct(Vector $rhs) {
		return (float)($this->_x * $rhs->_x) + ($this->_y * $rhs->_y) + ($this->_z * $rhs->_z);
	}

	public function cos(Vector $rhs) {
		return (float)(($this->_x * $rhs->_x) + ($this->_y * $rhs->_y) + ($this->_z * $rhs->_z)) / 
		sqrt((pow($this->_x, 2) + pow($this->_y, 2) + pow($this->_z, 2)) * (pow($rhs->_x, 2) + pow($rhs->_y, 2) + pow($rhs->_z, 2)));
	}

	public function crossProduct(Vector $rhs) {
		return new Vector (array('dest' => new Vertex (array(
		'x' => $this->_y * $rhs->_z - $this->_z * $rhs->_y,
		'y' => $this->_z * $rhs->_x - $this->_x * $rhs->_z,
		'z' => $this->_x * $rhs->_y - $this->_y * $rhs->_x
		))));
	}

	public function __get($propertyName) {
		if ($propertyName == '_x') {
			return $this->_x;
		} else if ($propertyName == '_y') {
			return $this->_y;
		} else if ($propertyName == '_z') {
			return $this->_z;
		}
	}
}

?>