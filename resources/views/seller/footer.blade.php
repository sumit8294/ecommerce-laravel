<script type="">
    var productDialog = document.getElementById('add-product')
    var categoryDialog = document.getElementById('add-category')
    var orderModal = document.getElementById('manage-order')

    let upid = 1;


    var hasParentCategory = document.getElementById('hasParent')

    function showProductModal(show){
        if(show){
            fetchCategories()
            productDialog.classList.remove('hidden')
        }
        else{
            productDialog.classList.add('hidden');
        } 
       
    }

    function showCategoryModal(show,$updateId = null){

        if(show){
            if($updateId){
                fetchCategoryToUpdate($updateId);
                hasParentCategory.checked = true;
                document.getElementsByClassName('parent-cat-field')[0].classList.remove('hidden')
                return;
            }
            categoryDialog.classList.remove('hidden')
        }
        else{
            categoryDialog.classList.add('hidden');
        }
       
    }


    function showParentCategories(){
        let parentCatOptions = document.getElementsByClassName('parent-cat-field')[0].classList
       
        if(hasParentCategory.checked){
            fetchCategories(1);
            parentCatOptions.remove('hidden')
        }else{
            parentCatOptions.add('hidden')
        }

        
    }

    function manageOrderDialog(show){
        if(show) orderModal.classList.remove('hidden')
        else orderModal.classList.add('hidden')
    }

    function getOrderStatus(){
        let orderStatus = document.getElementById('order-status')
        console.log(orderStatus.value)
    }

    function setIsEditable(event, button){
        event.preventDefault()
        // event.stopPropagation();
        let inputField = button.previousElementSibling;

        if (inputField.disabled) {
            inputField.disabled = false;  // Enable the input field
            inputField.focus();           // Optionally, set focus to the input field
        } else {
            inputField.disabled = true;   // Disable the input field
        }
    }

    function fetchCategoryToUpdate(id){

        $(document).ready(function() {
            // Fetch categories via AJAX
            $.ajax({
                url:"{{ route('categories') }}/"+id, // URL to fetch categories
                method: "GET",
                success: function(data) {
                    console.log(data)
                    if(data){
                        $('#catName').val(data.name)
                        $('#parentCatDescription').val(data.description)
                        $('#category-heading').text("Update Category")
                        $('#category-submit').text("Update")
                        $('#category-form').attr('action',"{{ url('./seller/category/update') }}/"+data.id)
                        $('#category-form').append('<input type="hidden" name="_method" value="PUT"/>')
                    }
                    fetchCategories(data.parent_id)
                    categoryDialog.classList.remove('hidden')
                },
                error: function(xhr) {
                    console.log('Error fetching categories:', xhr.responseText);
                }
            });
        });
    }

    function fetchProductToUpdate(id){
        
        $(document).ready(function(){
            $.ajax({
                url: `{{route('products')}}/`+id,
                method: 'GET',
                success: function (data){
                    
                    $('#product-name').val(data.name)
                    $('#product-sku').val(data.sku)
                    $('#product-description').val(data.description)
                    $('#product-quantity').val(data.quantity)
                    $('#product-mrp').val(data.mrp)
                    $('#product-selling-price').val(data.selling_price)
                    $('#product-tags').val(data.tags)
                    $('#previous-product-image').attr('src', '{{ asset('storage') }}/' + data.image);
                    fetchCategories(data.category_id)
                    $('#add-product').removeClass('hidden')
                    $('#product-form').attr('action',"{{ url('./seller/products/update') }}/"+data.id)
                    $('#product-submit').text('Update')
                    $('#product-form').append('<input type="hidden" name="_method" value="PUT"/>')
                },
                error: function(xhr) {
                    console.log('Error fetching categories:', xhr.responseText);
                }
            })
        })
    }

    function fetchCategories(selected){

        $(document).ready(function() {
            // Fetch categories via AJAX
            $.ajax({
                url:"{{ route('categories') }}", // URL to fetch categories
                method: "GET",
                success: function(data) {
                   
                    // Clear existing options
                    if(data.length > 0){
                        $('#category-select').empty();

                        // Add a default option
                        $('#category-select').append('<option value="">Select a category</option>');
                        $('#category-select').prop('disabled', false);
                        // Loop through each category and add to select
                        
                        $.each(data, function(index, category) {
                            $('#category-select').append(
                                $('<option></option>').val(category.id).text(category.name).prop('selected',selected === category.id)
                            );
                        });
                       
                    }else{
                        $('#category-select').empty();

                        // Add a default option
                        $('#category-select').append('<option value="" >No parent Category</option>');
                        $('#category-select').prop('disabled', true);
                    }
                },
                error: function(xhr) {
                    console.log('Error fetching categories:', xhr.responseText);
                }
            });
        });
    }


</script>