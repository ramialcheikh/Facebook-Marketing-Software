<style>
    .datagrid-view {
    height: 460px !important;
}
</style>
<?php $this->load->view('admin/theme/message'); ?>
<!-- Content Header (Page header) -->
<div class="col-xs-12">
<section class="card card-outline-info">
    <div class="table-heading2">
        <h4 class="card-title" > <?php echo $this->lang->line("package settings"); ?> </h4>  
    </div>
<!-- Main content -->
  
    <div class="col-xs-12 ">
        <div class="card" style="width:98%; height:600px;padding: 13px 15px;">
            <table 
            id="tt"  
            class="easyui-datagrid table-responsive" 
            url="<?php echo base_url()."payment/package_data"; ?>" 
            
            pagination="true" 
            rownumbers="true" 
            toolbar="#tb" 
            pageSize="50" 
            pageList="[5,10,20,50,100]"  
            fit= "true" 
            fitColumns= "true" 
            nowrap= "true" 
            view= "detailview"
            idField="id"
            >
            
                <thead>
                    <tr>
                        <th field="package_id" checkbox="true"></th>                        
                        <th field="id" sortable="true">Package ID</th>                        
                        <th field="package_name" sortable="true"><?php echo $this->lang->line("package name"); ?></th>
                        <th field="price" sortable="true" formatter="price_formatter"><?php echo $this->lang->line("price"); ?> - <?php echo $payment_config[0]['currency']; ?></th>
                        <th field="validity" sortable="true" formatter="validity_formatter"><?php echo $this->lang->line("validity"); ?> - <?php echo $this->lang->line("days"); ?></th>
                        <th field="is_default" formatter="is_default" sortable="true"><?php echo $this->lang->line("default package"); ?></th>
                        <th field="view" width="100px"  formatter='action_column'><?php echo $this->lang->line("actions"); ?></th>                    
                    </tr>
                </thead>
            </table>                        
         </div>
  
       <div id="tb" style="margin:13px 20px 10px">
            <a class="btn btn-warning"   href="<?php echo site_url('payment/add_package');?>">
                <i class="fa fa-plus-circle"></i> <?php echo $this->lang->line("add"); ?>
            </a> 
              
            <br/>      
            <br/>      
        </div>
    </div>
  
</section>
</div>

<script>       
    var base_url="<?php echo site_url(); ?>" 


    function action_column(value,row,index)
    {               
        var url=base_url+'payment/details_package/'+row.id;        
        var edit_url=base_url+'payment/update_package/'+row.id;
        var delete_url=base_url+'payment/delete_package/'+row.id;
        var more="<?php echo $this->lang->line('more info');?>";
        var edit_str="<?php echo $this->lang->line('edit');?>";
        var delete_str="<?php echo $this->lang->line('delete');?>";
        var str="";   
        str="<a title='"+more+"' style='cursor:pointer' href='"+url+"'>"+'<i class="fa fa-search" aria-hidden="true"></i>'+"</a>";
        str=str+"&nbsp;&nbsp;&nbsp;&nbsp;<a style='cursor:pointer' title='"+edit_str+"' href='"+edit_url+"'>"+'<i class="fa fa-pencil text-inverse m-r-10"></i>'+"</a>";
        if(row.is_default=='0')
        str=str+"<a onclick=\"return confirm('"+'<?php echo $this->lang->line("are you sure that you want to delete this record?"); ?>'+"')\" style='cursor:pointer' title='"+delete_str+"' href='"+delete_url+"'>"+'<i class="fa fa-close text-danger"></i>'+"</a>";
   		
   		return str;
    }     


    function is_default(value,row,index)
    {   
        if(value==1) return "<i class='fa fa-check' style='color:green;'></i>";            
        else return "<i class='fa fa-close' style='color:red;'></i>";     
    }

    function price_formatter(value,row,index)
    {   
        if(row.is_default=="1" && row.price=="0")
        return "Free"; 
        else return value;  
    }

    function validity_formatter(value,row,index)
    {   
        if(row.is_default=="1" && row.price=="0")
        return "Unlimited"; 
        else return value;    
    }


         

</script>


<script>
    
      $j("document").ready(function() {

        $("#add_custom_pack").click(function(){      
                  
          var redirect_url = "<?php echo site_url(); ?>payment/package_settings";
          var rows = $j('#tt').datagrid('getSelections');
          var info=JSON.stringify(rows);  
          if(rows=="") 
          {
            alert("Select one or more packages");
            return;
          } 

          $.ajax({
          type:'POST' ,
          url: "<?php echo site_url(); ?>payment/add_custom_package_action",
          data:{info:info},
          success:function(response)
          {
            window.location.href=redirect_url;
          }
        });   
      }); 
    });
</script>

