<script>
	function ShowTreeMenu( menu_kode )
	{
		$.ajax(
		{
			type: 'POST',    
			url: "<?= base_url('Global/MenuTree/GetMenuByMenuKode') ?>",
			data: 
			{
				menu_kode : menu_kode
			},
			success: function( response )
			{
				if(response)
				{
					ChShowTreeMenu( response );
				}
			}
		});
	}
	
	function ChShowTreeMenu( JSONMenuTree )
	{
		var strdef 	= '';
		
		strdef += 	'<div class="x_title">';
		strdef += 	'	<div class="clearfix"></div>';
		strdef +=	'</div>';
		
		$(".menutree").html( strdef );
		
		var MenuTree = JSON.parse( JSONMenuTree );
		
		var str = '';
		
		str += '<div class="tf-tree" style="font-size: 10pt;">';
		str += '<ul>';
		
		if( MenuTree.MenuTreeMenu != 0 )
		{
			var MenuParent = '';
			
			var numli = 0;
			
			for( i=0 ; i<MenuTree.MenuTreeMenu.length ; i++ )
			{
				var menu_kode_parent 	= MenuTree.MenuTreeMenu[i].menu_kode_parent;
				var menu_kode_child 	= MenuTree.MenuTreeMenu[i].menu_kode_child;
				var menu_nama 			= MenuTree.MenuTreeMenu[i].menu_nama;
				
				var menu_class 			= MenuTree.MenuTreeMenu[i].menu_class;
				var menu_link 			= MenuTree.MenuTreeMenu[i].menu_link;
				var menu_application	= MenuTree.MenuTreeMenu[i].menu_application;
				
				if( menu_application == 'MASTER' )
				{
					if( menu_link == '#sidebar-menu' )
					{
						str += '	<li><span class="tf-nc">'+ menu_nama +'</span>';
						str += '	<ul>';
						
						numli = parseInt(numli) + 1;
					}
					else if( menu_link != '#sidebar-menu' )
					{
						str += '	<li><span class="tf-nc">'+ menu_nama +'</span></li>';
					}
				}
				else if( menu_application == 'FAS' || menu_application == 'WMS' )
				{
					str += '	<li><span class="tf-nc">'+ menu_nama +'</span>';
					str += '	<ul>';
						
					numli = parseInt(numli) + 1;
				}	
			}
			
			for( j=0 ; j<numli ; j++ )
			{
				str += '	</ul>';
				str += ' </li>';
			}
		
			str += '</ul>';
		}
		
		$(".menutree").append(str);
		
		var strpenutup = '';
		strpenutup += '	</div>';
		
		$(".menutree").append( strpenutup );
			
	}
</script>