<script>
  $(document).ready(function(){
var query = $('#search').val();
var category = $('#category').val();
fetch_customer_data(query, category);
function fetch_customer_data(query = '', category= '')
{
 $.ajax({
  url:"{{ route('customsearch.action') }}",
  method:'GET',
  data:{query:query, category:category},
  dataType:'json',
  success:function(data)
  {
   $('.searchepico').html(data.table_data);
   $('#total_records').text(data.total_data);
  }
 })
}
$(document).on('keyup', '#search', function(){
  var query = $('#search').val();
  var category = $('#category').val();
  fetch_customer_data(query,category);
});
$(document).on('change', '#category', function(){
  var query = $('#search').val();
  var category = $('#category').val();
 fetch_customer_data(query,category);
});
});
</script>