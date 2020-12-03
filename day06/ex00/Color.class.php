<?PHP
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   Color.class.php                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: dthan <dthan@student.42.fr>                +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2020/06/22 01:19:06 by dthan             #+#    #+#             */
/*   Updated: 2020/06/22 01:28:14 by dthan            ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

Class Color {
	public $red = 0;
	public $green = 0;
	public $blue = 0;
	public static $verbose = false;

	public function __construct( array $rgbKey ) {
		if ( array_key_exists( 'rgb', $rgbKey )) {
			$this->red = intval( $rgbKey['rgb'] ) / (256 * 256) % 256;
			$this->green = intval( $rgbKey['rgb'] ) / 256 % 256;
			$this->blue = intval( $rgbKey['rgb'] ) % 256;
		}
		else if ( array_key_exists( 'red', $rgbKey ) && array_key_exists( 'green', $rgbKey ) && array_key_exists( 'blue', $rgbKey ) ) {
			$this->red = intval( $rgbKey['red'] );
			$this->green = intval( $rgbKey['green'] );
			$this->blue = intval( $rgbKey['blue'] );
		}
		if (self::$verbose === true)
			echo $this->__toString() . " constructed." . PHP_EOL;
		return ;
	}

	public function __destruct() {
		if (self::$verbose)
			echo $this->__toString() . " destructed." . PHP_EOL;
		return ;
	}

	public function __toString() {
		return (sprintf( "Color( red: %3d, green: %3d, blue: %3d )", $this->red, $this->green, $this->blue ));
	}

	public static function doc() {
		if ( $str = file_get_contents( 'Color.doc.txt' ) )
			echo $str;
		else
			echo "Error: .doc file doesn't exist." . PHP_EOL;
	}

	public function add( $Color ) {
		return new  Color( array( 'red' => $this->red + $Color->red, 'green' => $this->green + $Color->green, 'blue' => $this->blue + $Color->blue ) );
	}

	public function sub( $Color ) {
		return new  Color( array( 'red' => $this->red - $Color->red, 'green' => $this->green - $Color->green, 'blue' => $this->blue - $Color->blue ) );
	}

	public function mult( $x ) {
		return new  Color( array( 'red' => $this->red * $x, 'green' => $this->green * $x, 'blue' => $this->blue * $x ) );
	}
}

?>