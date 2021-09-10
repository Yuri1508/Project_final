<?php

    require_once 'Database.class.php';

    $oop = new Model();
    $oop->con();

    class Model extends Database
    {

		public function insertData($product, $description, $price)
        {
			$sql = "INSERT INTO `tab_shop`(`name_product`, `description_product`, `price_product`) VALUES  (:product, :description, :price)";

			$stmt = $this->connect->prepare($sql);
			$stmt->execute(['product'=>$product, 'description'=>$description, 'price'=>$price]);

			return true;
		}

		public function insertImage($image)
        {
			$sql = "INSERT INTO `tab_shop`(`image_product`) VALUES  (:image)";

			$stmt = $this->connect->prepare($sql);
			$stmt->execute(['image'=>$image]);

			return true;
		}

		public function getData()
        {
			$data = array();
			$sql = "SELECT * FROM `tab_shop`";

			$stmt = $this->connect->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach ($result as $row) {
				$data[] = $row;
			}

			return $data;
		}

		public function getDataById($id)
        {
			$sql = "SELECT * FROM `tab_shop` WHERE id = :id";

			$stmt = $this->connect->prepare($sql);
			$stmt->execute(['id'=>$id]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result;
		}

		public function updateData($id, $product, $description, $price)
        {
			$sql = "UPDATE `tab_shop` SET `name_product` = :product, `description_product` = :description, `price_product` = :price WHERE id = :id";

			$stmt = $this->connect->prepare($sql);
			$stmt = $stmt->execute(['product'=>$product, 'description'=>$description, 'price'=>$price, 'id'=>$id]);

			return true;
		}

		public function deleteData($id){
			$sql = "DELETE from `tab_shop` WHERE id = :id";

			$stmt = $this->connect->prepare($sql);
			$stmt->execute(['id'=>$id]);

			return true;
		}

		public function totalRow()
		{
			$sql = "SELECT * FROM `tab_shop`";

			$stmt = $this->connect->prepare($sql);
			$stmt->execute();
			$t_rows = $stmt->rowCount();

			return $t_rows;
		}

    }

    $oop = new Database();
    
?>