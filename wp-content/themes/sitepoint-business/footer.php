<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id #maincontentcontainer div and all content after.
 * There are also four footer widgets displayed. These will be displayed from
 * one to four columns, depending on how many widgets are active.
 *
 * @package SitePoint Business
 * @since SitePoint Business 1.0
 */
?>
<?php
      $frontpage_id = get_option( 'page_on_front' );
 ?>

<?php
if(function_exists("register_field_group")) { ?>
<section id="contact-section">
  <div class="grid-container bottom-section">
    <h2 class="text-align-center">
      <?php
      $title = get_field('contact_title', $frontpage_id);
      if( !empty($title) ):
      ?><?php echo $title;  ?>
      <?php endif; ?>

      <?php
      $text = get_field('contact_sub_text', $frontpage_id);

      if( !empty($text) ):
      ?><span class="aligncenter"><?php echo $text; ?></span>
    <?php endif; ?>
    </h2>

      <div class="col grid-50 tablet-grid-50">
        <?php
         $contact_form = get_field('contact_form', $frontpage_id);
        if( !empty($contact_form) ): ?>
        <?php echo $contact_form; ?>
        <?php endif; ?>
      </div>

      <div class="col grid-50 tablet-grid-50">
        <?php
        $location = get_field('google_map', $frontpage_id);
        if( !empty($location) ):
        ?>
        <div class="acf-map">
<!--         	<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
            <h3><?php echo $location['address'] ?></h3>
          </div> -->
          <!--百度地图容器-->
          <div style="width:548px;height:398px;border:#ccc solid 1px;" id="dituContent"></div>
        </div>
        <?php endif; ?>

        <?php
         if(get_field('below_map_info', $frontpage_id)) { ?>
          <div class="address-text">
              <?php echo get_field('below_map_info', $frontpage_id); ?>
          </div>
        <?php } ?>
      </div>
  </div>


</section>
<?php } ?>
<?php
if(function_exists("register_field_group"))
{
 $contact_form = get_field('contact_form', $frontpage_id);
if( !empty($contact_form) ): ?>
  <div class="sticky-form">
    <?php echo $contact_form; ?>
  </div>

  <div class="contact-float">
  	<div class="sticky-btn">
      <span>
      <svg class="open" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><path  d="M40 4H8C5.79 4 4.02 5.79 4.02 8L4 44l8-8h28c2.21 0 4-1.79 4-4V8c0-2.21-1.79-4-4-4zM18 22h-4v-4h4v4zm8 0h-4v-4h4v4zm8 0h-4v-4h4v4z"/></svg>
      <svg class="close" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><path d="M38 12.83L35.17 10 24 21.17 12.83 10 10 12.83 21.17 24 10 35.17 12.83 38 24 26.83 35.17 38 38 35.17 26.83 24z"/></svg>
      </span>
      <span class="spantext"><?php _e( 'Contact Us', 'my-text-domain' ); ?></span>
  	</div>
  </div>
<?php endif; } ?>

	<?php	do_action( 'sitepoint_business_after_woocommerce' ); ?>
	<div id="footercontainer">
		<?php get_sidebar( 'footer' ); ?>
		<div class="grid-container">
			<div class="grid-25 tablet-grid-25">
				 <div class="site-title">
				 		<a href="<?php echo site_url() ?>"><?php echo get_bloginfo( 'name' ) ?></a>
				 </div>
			</div>
      <div class="grid-50 tablet-grid-50">
        <?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'navigation nav-menu', 'container_class' => 'navigation_container' ) ); ?>
      </div>
			<div class="grid-25 tablet-grid-25">
					<!-- social media icons here -->
					<ul class="social-media">
						<?php if(get_theme_mod('sitepoint_business_linkedin')) : ?><li><a href="<?php echo esc_html(get_theme_mod('sitepoint_business_linkedin')); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php endif; ?>
						<?php if(get_theme_mod('sitepoint_business_twitter')) : ?><li><a href="http://twitter.com/<?php echo esc_html(get_theme_mod('sitepoint_business_twitter')); ?>" target="_blank"><i class="fa fa-twitter"></i></a></i></a></li><?php endif; ?>
						<?php if(get_theme_mod('sitepoint_business_facebook')) : ?><li><a href="http://facebook.com/<?php echo esc_html(get_theme_mod('sitepoint_business_facebook')); ?>" target="_blank"><i class="fa fa-facebook-official"></i></a></li><?php endif; ?>
						<?php if(get_theme_mod('sitepoint_business_google')) : ?><li><a href="http://plus.google.com/<?php echo esc_html(get_theme_mod('sitepoint_business_google')); ?>" target="_blank"><i class="fa fa-google-plus-square"></i></a></li><?php endif; ?>
					</ul>
			</div>
		</div>
    <div class="grid-container">
      <div class="grid-50 tablet-grid-50">
        <p class="copyright"><?php echo wp_kses_post(get_theme_mod('sitepoint_business_footer_copyright_left')); ?></p>
      </div>
      <div class="grid-50 tablet-grid-50">
        <!-- <span class="terms alignright"><a href="">Terms & Conditions</a> | <a href="#">Privacy Policy</a></span> -->
        <?php wp_nav_menu( array( 'theme_location' => 'terms', 'menu_class' => 'terms' ) ); ?>
      </div>
    </div>
	</div> <!-- /.footercontainer -->

</div> <!-- /.#wrapper.hfeed.site -->

<?php wp_footer(); ?>
<div class="overlay-modal"></div>
</body>
<script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
        addMarker();//向地图中添加marker
        addRemark();//向地图中添加文字标注
    }
    
    //创建地图函数：
    function createMap(){
        var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
        var point = new BMap.Point(116.29621,39.893405);//定义一个中心点坐标
        map.centerAndZoom(point,15);//设定地图的中心点和坐标并将地图显示在地图容器中
        window.map = map;//将map变量存储在全局
    }
    
    //地图事件设置函数：
    function setMapEvent(){
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
        map.disableScrollWheelZoom();//禁用地图滚轮放大缩小，默认禁用(可不写)
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }
    
    //地图控件添加函数：
    function addMapControl(){
        //向地图中添加缩放控件
    var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
    map.addControl(ctrl_nav);
                //向地图中添加比例尺控件
    var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
    map.addControl(ctrl_sca);
    }
    
    //标注点数组
    var markerArr = [{title:"荣汇鑫颗",content:"公司简介：<br/>北京荣汇鑫颗科技有限公司，成立于2013年，主要从事移动、联通、电信、铁塔的室内分布基础建设和WIFI及WLAN局域网无线覆盖工程，经过四年多的努力与发展，已具有一定规模及实力，现拥有一支稳定的团队，以卓越的服务品质和专业的技术服务实力，为客户提供更优质的服务。",point:"116.296075|39.893322",isOpen:0,icon:{w:21,h:21,l:0,t:0,x:6,lb:5}}
         ];
    //创建marker
    function addMarker(){
        for(var i=0;i<markerArr.length;i++){
            var json = markerArr[i];
            var p0 = json.point.split("|")[0];
            var p1 = json.point.split("|")[1];
            var point = new BMap.Point(p0,p1);
            var iconImg = createIcon(json.icon);
            var marker = new BMap.Marker(point,{icon:iconImg});
            var iw = createInfoWindow(i);
            var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
            marker.setLabel(label);
            map.addOverlay(marker);
            label.setStyle({
                        borderColor:"#808080",
                        color:"#333",
                        cursor:"pointer"
            });
            
            (function(){
                var index = i;
                var _iw = createInfoWindow(i);
                var _marker = marker;
                _marker.addEventListener("click",function(){
                    this.openInfoWindow(_iw);
                });
                _iw.addEventListener("open",function(){
                    _marker.getLabel().hide();
                })
                _iw.addEventListener("close",function(){
                    _marker.getLabel().show();
                })
                label.addEventListener("click",function(){
                    _marker.openInfoWindow(_iw);
                })
                if(!!json.isOpen){
                    label.hide();
                    _marker.openInfoWindow(_iw);
                }
            })()
        }
    }
    //创建InfoWindow
    function createInfoWindow(i){
        var json = markerArr[i];
        var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
        return iw;
    }
    //创建一个Icon
    function createIcon(json){
        var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
        return icon;
    }
//文字标注数组
    var lbPoints = [{point:"116.295841|39.893246",content:"北京荣汇鑫颗科技有限公司<br/><br/>地址：靛厂村内101号楼<br/>电话："}
         ];
    //向地图中添加文字标注函数
    function addRemark(){
        for(var i=0;i<lbPoints.length;i++){
            var json = lbPoints[i];
            var p1 = json.point.split("|")[0];
            var p2 = json.point.split("|")[1];
            var label = new BMap.Label("<div style='padding:2px;'>"+json.content+"</div>",{point:new BMap.Point(p1,p2),offset:new BMap.Size(3,-6)});
            map.addOverlay(label);
            label.setStyle({borderColor:"#999"});
        }
    }
    
    initMap();//创建和初始化地图
</script>
</html>
