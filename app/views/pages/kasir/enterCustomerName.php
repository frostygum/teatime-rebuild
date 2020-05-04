<div class="container-fluid">

    <?php 
        require_once VIEW_PATH . "templates/header.php";
    ?>
    
    <div class="display-flex justify-content-center align-items-center" style="min-height: 90vh">
        <div class="card px-2 py-2 bg-teal text-light shadow">
            <div class="card-body text-center p-2">
                <h4>Customer Name</h4>
                <form action="./kasir" method="post">
                    <input type="text" name="customer_name" class="input block border-0 my-2 mt-4 text-bold" placeholder="type customer name" />
                    <input type="hidden" name="set_page" value="1" />
                    <button class="btn btn-primary bg-primary shadow text-bold block py-1 mt-2">
                        Start Order
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>