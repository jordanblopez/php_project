<!-- Cart Functions -->
<?php
session_start();


class Cart {
  protected $cart_contents =[];

  //Constructor for the function
  function __construct(){
    $this->cart_contents = !empty($_SESSION['cart_contents'])?$_SESSION['cart_contents']:NULL;
    //if there are no cart_contents then set the values
    if ($this->cart_contents === NULL) {
      //Setting values
      $this->cart_contents=['cart_total'=>0,'total_items'=>0];
    }
  }

  //When called this function will get the cart_contents and put them in array cart
  public function contents(){
    //Newest first
    $cart = array_reverse($this->cart_contents);

    unset($cart['total_items']);
    unset($cart['cart_total']);

    return $cart;
  }

  //Insert an item into the cart
  public function insert_item($item = array()){
      if(!is_array($item) OR count($item) === 0){
          return FALSE;
      }else{
          if(!isset($item['product_id'], $item['display_name'], $item['price'], $item['qty'])){
              return FALSE;
          }else{

              // prep the quantity
              $item['qty'] = (float) $item['qty'];
              if($item['qty'] == 0){
                  return FALSE;
              }
              // prep the price
              $item['price'] = (float) $item['price'];
              // create a unique identifier for the item being inserted into the cart
              $rowid = md5($item['product_id']);
              // get quantity if it's already there and add it on
              $old_qty = isset($this->cart_contents[$rowid]['qty']) ? (int) $this->cart_contents[$rowid]['qty'] : 0;
              // re-create the entry with unique identifier and updated quantity
              $item['rowid'] = $rowid;
              $item['qty'] += $old_qty;
              $this->cart_contents[$rowid] = $item;

              // save Cart Item
              if($this->save_cart()){
                  return isset($rowid) ? $rowid : TRUE;
              }else{
                  return FALSE;
              }
          }
      }
  }

  //Gets the item based on row_id
  public function get_item($row_id){
    return (in_array($row_id, array('total_items', 'cart_total'), TRUE) OR ! isset($this->cart_contents[$row_id]))
            ? FALSE
            : $this->cart_contents[$row_id];
    }

    //Remove an item from the cart
     public function remove_item($row_id){
        // unset the item
        unset($this->cart_contents[$row_id]);
        // and then save the cart again
        $this->save_cart();
        return TRUE;
     }

    //Count of all items in the cart
    public function total_items(){
        return $this->cart_contents['total_items'];
    }

    //Get the total for the items in the cart
    public function total(){
        return $this->cart_contents['cart_total'];
    }

    //Update the cart
    public function update_cart($item = array()){
        if (!is_array($item) OR count($item) === 0){
            return FALSE;
        }else{
            if (!isset($item['rowid'], $this->cart_contents[$item['rowid']])){
                return FALSE;
            }else{
                // Check the quantity 
                if(isset($item['qty'])){
                    $item['qty'] = (float) $item['qty'];
                    // remove the item from the cart, if quantity is zero
                    if ($item['qty'] == 0){
                        unset($this->cart_contents[$item['rowid']]);
                        return TRUE;
                    }
                }

                // find updatable keys
                $keys = array_intersect(array_keys($this->cart_contents[$item['rowid']]), array_keys($item));
                // prep the price
                if(isset($item['price'])){
                    $item['price'] = (float) $item['price'];
                }
                // product id & name shouldn't be changed
                foreach(array_diff($keys, array('id', 'name')) as $key){
                    $this->cart_contents[$item['rowid']][$key] = $item[$key];
                }
                // save cart data
                $this->save_cart();
                return TRUE;
            }
        }
    }

    //Save the cart array to the sesison
    protected function save_cart(){
        $this->cart_contents['total_items'] = $this->cart_contents['cart_total'] = 0;
        //Loop through each item in the array
        foreach ($this->cart_contents as $key => $val){
            // make sure the array contains the proper indexes
            if(!is_array($val) OR !isset($val['price'], $val['qty'])){
                continue;
            }
            //
            $this->cart_contents['cart_total'] += ($val['price'] * $val['qty']);
            $this->cart_contents['total_items'] += $val['qty'];
            $this->cart_contents[$key]['subtotal'] = ($this->cart_contents[$key]['price'] * $this->cart_contents[$key]['qty']);
        }

        // if cart empty, delete it from the session
        if(count($this->cart_contents) <= 2){
            //unset($_SESSION['cart_contents']);
            $this->destroy_cart();
            return FALSE;
        }else{
            $_SESSION['cart_contents'] = $this->cart_contents;
            return TRUE;
        }
    }

    //empty the cart and destroy the session
    public function destroy_cart(){
        //Zero out the cart contents array
        $this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
        //Unset the cart_contents
        unset($_SESSION['cart_contents']);
    }
}



 ?>
