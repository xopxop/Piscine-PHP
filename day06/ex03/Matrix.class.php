<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   Matrix.class.php                                   :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: dthan <dthan@student.hive.fi>              +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2020/11/18 14:35:34 by dthan             #+#    #+#             */
/*   Updated: 2020/11/18 14:35:34 by dthan            ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

require_once 'Color.class.php';
require_once 'Vertex.class.php';
require_once 'Vector.class.php';

class Matrix {
	const IDENTITY = "IDENTITY";
	const SCALE = "SCALE";
	const RX = "Ox ROTATION";
	const RY = "Oy ROTATION";
	const RZ = "Oz ROTATION";
	const TRANSLATION = "TRANSLATION";
	const PROJECTION = "PROJECTION";

	private $_matrix;
	private $_preset;
	private $_scale;
	private $_vtc;
	private $_angle;
	private $_fov;
	private $_ratio;
	private $_near;
	private $_far;


	static $verbose = false;

	public function __construct ( $array = null ) {
		if (!isset($array))
			return ;
		if (isset($array['preset'])) {
			$this->_preset = $array['preset'];
		}
		if (isset($array['scale'])) {
			$this->_scale = $array['scale'];
		}
		if (isset($array['angle'])) {
			$this->_angle = $array['angle'];
		}
		if (isset($array['vtc'])) {
			$this->_vtc = $array['vtc'];
		}
		if (isset($array['fov'])) {
			$this->_fov = $array['fov'];
		}
		if (isset($array['ratio'])) {
			$this->_ratio = $array['ratio'];
		}
		if (isset($array['near'])) {
			$this->_near = $array['near'];
		}
		if (isset($array['far'])) {
			$this->_far = $array['far'];
		}
		/* parsing */
		if (empty($this->_preset)) {
			exit();
		}
		if ($this->_preset == self::SCALE && empty($this->_scale)) {
			exit();
		}
		if ( ($this->_preset == self::RX || $this->_preset == self::RY ||
			$this->_preset == self::RZ) && empty($this->_angle) ) {
			exit();
		}
		if ($this->_preset == self::TRANSLATION && empty($this->_vtc)) {
			exit();
		}
		if ($this->_preset == self::PROJECTION && empty($this->_fov)) {
			exit();
		}
		if ($this->_preset == self::PROJECTION && empty($this->_ratio)) {
			exit();
		}
		if ($this->_preset == self::PROJECTION && empty($this->_far)) {
			exit();
		}
		/* init matrix */
		for ($i = 0; $i < 4; $i++) {
			for ($j = 0; $j < 4; $j++) {
				$this->_matrix[$i][$j] = 0;
			}
		}
		if (self::$verbose) {
			echo "Matrix ". $this->_preset;
			echo ($this->_preset != self::IDENTITY) ? " preset" : "";
			echo " instance constructed" . PHP_EOL; 
			$this->_chooseMatrix();
		}
	}

	public function __destruct() {
		if (self::$verbose) {
			echo "Matrix instance destructed" . PHP_EOL;
		}
	}

	public function __toString() {
		$output = "M | vtcX | vtcY | vtcZ | vtxO\n";
		$output .= "-----------------------------\n";
		$output .= "x | %0.2f | %0.2f | %0.2f | %0.2f\n";
		$output .= "y | %0.2f | %0.2f | %0.2f | %0.2f\n";
		$output .= "z | %0.2f | %0.2f | %0.2f | %0.2f\n";
		$output .= "w | %0.2f | %0.2f | %0.2f | %0.2f";
		return sprintf($output,
						$this->_matrix[0][0], $this->_matrix[0][1], $this->_matrix[0][2], $this->_matrix[0][3],
						$this->_matrix[1][0], $this->_matrix[1][1], $this->_matrix[1][2], $this->_matrix[1][3],
						$this->_matrix[2][0], $this->_matrix[2][1], $this->_matrix[2][2], $this->_matrix[2][3],
						$this->_matrix[3][0], $this->_matrix[3][1], $this->_matrix[3][2], $this->_matrix[3][3]
					);
	}

	public static function doc() {
		if ( $str = file_get_contents( 'Matrix.doc.txt' ) )
			echo $str;
		else
			echo "Error: .doc file doesn't exist." . PHP_EOL;
	}

	private function _chooseMatrix() {
		$this->_identityMatrix();
		if ($this->_preset === self::TRANSLATION) {
			$this->_translationMatrix($this->_vtc);
		} else if ($this->_preset === self::SCALE) {
			$this->_scaleMatrix($this->_scale);
		} else if ($this->_preset === self::RX) {
			$this->_rotationMatrix(array('x' => $this->_angle));
		} else if ($this->_preset === self::RY) {
			$this->_rotationMatrix(array('y' => $this->_angle));
		} else if ($this->_preset === self::RZ) {
			$this->_rotationMatrix(array('z' => $this->_angle));
		} else if ($this->_preset === self::PROJECTION) {
			$this->_projectionMatrix();
		}
	}

	private function _identityMatrix() {
		$this->_matrix[0][0] = 1;
		$this->_matrix[1][1] = 1;
		$this->_matrix[2][2] = 1;
		$this->_matrix[3][3] = 1;
	}

	private function _translationMatrix() {
		$this->_matrix[0][3] = $this->_vtc->_x;
		$this->_matrix[1][3] = $this->_vtc->_y;
		$this->_matrix[2][3] = $this->_vtc->_z;
	}

	private function _scaleMatrix($scaleFactor) {
		$this->_matrix[0][0] = $scaleFactor;
		$this->_matrix[1][1] = $scaleFactor;
		$this->_matrix[2][2] = $scaleFactor;
	}

	private function _rotationMatrix($rotation_angle) {
		if (isset($rotation_angle['x'])) {
			$this->_matrix[1][1] = cos($this->_angle);
			$this->_matrix[1][2] = -sin($this->_angle);
			$this->_matrix[2][1] = sin($this->_angle);
			$this->_matrix[2][2] = cos($this->_angle);
		}
		else if (isset($rotation_angle['y'])) {
			$this->_matrix[0][0] = cos($this->_angle);
			$this->_matrix[0][2] = sin($this->_angle);
			$this->_matrix[2][0] = -sin($this->_angle);
			$this->_matrix[2][2] = cos($this->_angle);
		}
		else if (isset($rotation_angle['z'])) {
			$this->_matrix[0][0] = cos($this->_angle);
			$this->_matrix[0][1] = -sin($this->_angle);
			$this->_matrix[1][0] = sin($this->_angle);
			$this->_matrix[1][1] = cos($this->_angle);
		}
	}

	private function _projectionMatrix() {
		$this->_matrix[1][1] = 1 / tan(0.5 * deg2rad($this->_fov));
		$this->_matrix[0][0] = $this->_matrix[1][1] / $this->_ratio;
		$this->_matrix[2][2] = -1 * (-$this->_near - $this->_far) / ($this->_near - $this->_far);
		$this->_matrix[2][3] = (2 * $this->_near * $this->_far) / ($this->_near - $this->_far);;
		$this->_matrix[3][2] = -1;
		$this->_matrix[3][3] = 0;
	}

	public function mult(Matrix $rhs) {
		$matrix;
		for($i = 0; $i < 4; $i++) {
			for($j=0; $j < 4; $j++){
				$matrix[$i][$j] = 0;
				for($k=0; $k < 4; $k++){
					$matrix[$i][$j] += $this->_matrix[$i][$k] * $rhs->_matrix[$k][$j];
        		}
    		}
		}
		$new = new Matrix();
		$new->_matrix = $matrix;
		return $new;
	}

	public function transformVertex(Vertex $vtx) {
		$tmp = array();
		$tmp['x'] = (
			$vtx->_x * $this->_matrix[0][0] +
			$vtx->_y * $this->_matrix[0][1] +
			$vtx->_z * $this->_matrix[0][2] +
			$vtx->_w * $this->_matrix[0][3]
		);
		$tmp['y'] = (
			$vtx->_x * $this->_matrix[1][0] +
			$vtx->_y * $this->_matrix[1][1] +
			$vtx->_z * $this->_matrix[1][2] +
			$vtx->_w * $this->_matrix[1][3]
		);
		$tmp['z'] = (
			$vtx->_x * $this->_matrix[2][0] +
			$vtx->_y * $this->_matrix[2][1] +
			$vtx->_z * $this->_matrix[2][2] +
			$vtx->_w * $this->_matrix[2][3]
		);
		$tmp['w'] = (
			$vtx->_x * $this->_matrix[3][0] +
			$vtx->_y * $this->_matrix[3][1] +
			$vtx->_z * $this->_matrix[3][2] +
			$vtx->_w * $this->_matrix[3][3]
		);
		return new Vertex($tmp);
	}
}

?>