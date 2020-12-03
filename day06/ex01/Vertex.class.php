<?PHP
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   Vertex.class.php                                   :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: dthan <dthan@student.42.fr>                +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2020/06/22 04:57:25 by dthan             #+#    #+#             */
/*   Updated: 2020/06/22 04:57:25 by dthan            ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

require_once 'Color.class.php';

Class Vertex {
	private $_x;
	private $_y;
	private $_z;
	private $_w = 1.0;
	private $_color;
	static $verbose = false;

	public function __construct( $array ) {
		$this->_x = $array['x'];
		$this->_y = $array['y'];
		$this->_z = $array['z'];
		if ( array_key_exists( 'w', $array ) )
			$this->_w = $array['w'];
		if ( array_key_exists( 'color', $array ) && $array['color'] instanceof Color )
			$this->_color = $array['color'];
		else
			$this->_color = new Color( array( 'red'=>255, 'green'=>255, 'blue'=>255 ) );
		if (self::$verbose)
			echo $this->__toString() . " constructed" . PHP_EOL;
	}

	public function __destruct() {
		if (self::$verbose)
			echo $this->__toString() . " destructed" . PHP_EOL;
		return ;
	}
	public function __toString() {
		$str = sprintf( "Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f", $this->_x, $this->_y, $this->_z , $this->_w );
		if (self::$verbose == true)
			$str .= ", " . $this->_color->__toString();
		$str .= " )";
		return $str;
	}

	public static function doc() {
		if ( $str = file_get_contents( 'Vertex.doc.txt' ) )
			echo $str;
		else
			echo "Error: .doc file doesn't exist." . PHP_EOL;
	}

	public function __get($propertyName) {
		if ($propertyName == '_x') {
			return $this->_x;
		} else if ($propertyName == '_y') {
			return $this->_y;
		} else if ($propertyName == '_z') {
			return $this->_z;
		} else if ($propertyName == '_w') {
			return $this->_w;
		}
	}
}

?>