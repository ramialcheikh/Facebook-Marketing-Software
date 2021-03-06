<section class="content-header">
   <section class="content col-md-8 col-sm-12 col-xs-12 form-cont">
     <div class="box box-info custom_box">
       <div class="box-header">
         <h3 class="box-title new"> <?php echo $this->lang->line("details")." - ".$this->lang->line("package settings"); ?></h3>
       </div><!-- /.box-header -->
       <!-- form start -->
       <form class="form-horizontal user-box">
         <div class="box-body1">
           <div class="form-group form-group2">
            
            <!-- <label class="col-sm-2 control-label left" for="name">  </label>-->
             <div class="col-sm-12 detail-table" style="padding-top:7px">
             	 <h4><?php echo $this->lang->line("package name")?> : 
               <?php echo $value[0]["package_name"];?> @
               <?php echo $payment_config[0]['currency']; ?> <?php echo $value[0]["price"];?> /
               <?php echo $value[0]["validity"];?> <?php echo $this->lang->line("days")?>
               </h4>
            
             </div>
           </div>

           <div class="form-group">
              
            <!-- <label class="col-sm-2 control-label left" for=""></label>-->
             <div class="col-sm-12 table-responsive">

             <table class="table table-bordered table-condensed table-hover table-striped">
              <tr>
               <td colspan="5" align="center"><?php echo $this->lang->line("0 means unlimited");?></td>
              </tr>
               <?php                   

                    $current_modules=array();
                    $current_modules=explode(',',$value[0]["module_ids"]); 
                    $monthly_limit=json_decode($value[0]["monthly_limit"],true);
                    $bulk_limit=json_decode($value[0]["bulk_limit"],true);

                    echo "<tr>";    
                        echo "<th class='text-center success'>"; 
                          echo $this->lang->line("modules");         
                        echo "</th>";
                        echo "<th class='text-center success' colspan='2'>"; 
                          echo $this->lang->line("Analysis Limit");         
                        echo "</th>";
                        // echo "<th class='text-center success' colspan='2'>"; 
                        //   echo $this->lang->line("Bulk Limit");         
                        // echo "</th>";
                    echo "</tr>";    

                    foreach($modules as $module) 
                    {  
                     
                     if(in_array($module["id"],$current_modules))
                     {
                        echo "<tr>";    
                          echo "<td>";
                            echo "<b>".$this->lang->line($module['module_name'])."</b>";                
                        echo "</td>";

                        $xmonthly_val=0;
                        $xbulk_val=0;

                        if(in_array($module["id"],$current_modules))
                        {
                          $xmonthly_val=$monthly_limit[$module["id"]];
                          $xbulk_val=$bulk_limit[$module["id"]];
                        }

                        if(in_array($module["id"],array(13,14,16,17,24,26,27,33,38,39,40,41,42,43,44,45,46,47,48,49,52,53,55,57,59,60,61,62,63,77,78,82,83)))
                        {
                          $type="hidden";
                          $limit="";

                        }
                        else
                        {
                            $type="number";
                            if($module["id"]=="1") $limit=$this->lang->line("Analysis Limit");
                            else $limit=$this->lang->line("Analysis Limit")." / ".$this->lang->line("Month");
                       }

                        echo "<td style='padding-left:10px'>".$limit."</td><td><input type='".$type."' disabled='disabled' value='".$xmonthly_val."' style='width:70px;' name='monthly_".$module['id']."'></td>";
                        
                        if(!in_array($module["id"],array(3,4,5,6,7,8,9,10,15,18,21,22,58)))
                        {
                          $type="hidden";
                          $limit="";
                        }
                        else
                        {
                          $type="text";
                          $limit=$this->lang->line("Bulk Limit")." / ".$this->lang->line("Analysis");
                        }

                        // echo "<td style='padding-left:10px'>".$limit."</td><td><input type='".$type."' disabled='disabled' value='".$xbulk_val."' style='width:70px;' name='bulk_".$module['id']."'></td>";
                        echo "</tr>";      
                      }           
                   }                
                ?>            
              </table>     
               <span class="red" ><?php echo "<br/><br/>".form_error('modules'); ?></span>  
              </div> 
                 
          </div>      
           </div> <!-- /.box-body -->         
         </div><!-- /.box-info -->       
      
   </section>
</section>

<style type="text/css" media="screen">
  td,th{background:#fff}
</style>