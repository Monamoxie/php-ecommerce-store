<?php
class Product extends Model 
{   
    private $rows; 
    protected $session;
    
    public function getAllProducts()
    {
        $this->db->runQuery("SELECT * FROM products");
        if ($this->db->numRows() > 0) {
            while ($fetch = $this->db->getData()) {
               $this->rows[] = $fetch;
            }
        }
        return $this->rows; 
    }

    public function getSingleProduct($id) 
    {
        $this->db->runQuery("SELECT * FROM products WHERE id = '$id' ");
        if ($this->db->numRows() > 0) { 
            $row = $this->db->getData();
            return $row;
        }
        return false;
    }

    public function getSingleProductPrice($id)
    {
        $this->db->runQuery("SELECT price FROM products WHERE id = '$id' ");
        if ($this->db->numRows() > 0) { 
            $row = $this->db->getData();
            return $row["price"];
        }
        return false;
    } 

    /**
    * @param int
    * @return array
    */
    public function getProductRating($product_Id)
    {
        $this->rows = [];
        $this->db->runQuery("SELECT total_rate_points, total_raters, average_rating FROM products WHERE id  = '$product_Id' ");
        if ($this->db->numRows() > 0) {
            $this->rows = $this->db->getData(); 
        }
        return $this->rows;
    }

    public function updateProductRating($product_Id, $existing_Ratings, $new_Rating) 
    {
        $new_Total_Rate_Points = $existing_Ratings["total_rate_points"] + $new_Rating;
        $new_Total_Raters = $existing_Ratings["total_raters"] + 1;
        $new_Average_Rating = floor($new_Total_Rate_Points / $new_Total_Raters);
        
        $data = [ 
            'total_rate_points' => $new_Total_Rate_Points,
            'total_raters' =>  $new_Total_Raters,
            'average_rating' => $new_Average_Rating
        ];
        if (!$this->db->updateData("products", $data, 'id = '.$product_Id)) 
        {
            return false;
        }  
        return $new_Average_Rating;
    }
 
}