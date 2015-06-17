"undefined"==typeof Videos&&(Videos={}),Videos.Explorer=Garnish.Base.extend({previewModal:null,previewInject:null,searchTimeout:null,init:function(e,t){this.settings=t,this.$container=e,this.$spinner=$(".spinner",this.$container),this.$gateways=$(".gateways select",this.$container),this.$sectionLinks=$("nav a",this.$container),this.$search=$(".search",this.$container),this.$videos=$(".videos",this.$container),this.addListener(this.$sectionLinks,"click",$.proxy(function(e){this.$sectionLinks.filter(".sel").removeClass("sel"),$(e.currentTarget).addClass("sel"),gateway=$(e.currentTarget).data("gateway"),method=$(e.currentTarget).data("method"),options=$(e.currentTarget).data("options"),this.getVideos(gateway,method,options),e.preventDefault()})),this.addListener(this.$search,"textchange",$.proxy(function(e){this.searchTimeout&&clearTimeout(this.searchTimeout),this.searchTimeout=setTimeout($.proxy(this,"search",e),500)},this)),this.addListener(this.$search,"keypress",function(e){e.keyCode==Garnish.RETURN_KEY&&(e.preventDefault(),this.search(e))}),$("nav div:not(.hidden) a:first",this.$container).trigger("click")},search:function(e){q=$(e.currentTarget).val(),q.length>0?(gateway=this.$gateways.val(),method="search",options={q:q},this.getVideos(gateway,method,options)):this.$videos.html("")},showPreview:function(e){var t=$(e.currentTarget).data("gateway"),i=$(e.currentTarget).data("id");if(this.previewModal)this.previewModal.show();else{var s=$('<form id="videos-preview-form" class="modal fitted"/>').appendTo(Garnish.$bod),n=$('<div class="body"></div>').appendTo(s);this.$previewInject=$('<div class="inject"/>').appendTo(n);{var a=$('<div class="buttons right"/>').appendTo(n),o=$('<div class="btn">'+Craft.t("Cancel")+"</div>").appendTo(a);$('<input type="submit" class="btn submit" value="'+Craft.t("Continue")+'" />').appendTo(a)}this.previewModal=new Garnish.Modal(s,{visible:!1,resizable:!0,onHide:$.proxy(function(){this.$previewInject.html("")},this)}),this.addListener(o,"click",function(){this.previewModal.hide()})}var r={gateway:t,videoId:i};Craft.postActionRequest("videos/preview",r,$.proxy(function(e,t){this.$previewInject.html(e.html),this.previewModal.updateSizeAndPosition()},this))},selectVideo:function(e){this.$videoElements.removeClass("sel"),$(e.currentTarget).addClass("sel"),url=$(e.currentTarget).data("url"),this.settings.onSelectVideo(url)},getVideos:function(e,t,i){data={gateway:e,method:t,options:i},this.$spinner.removeClass("hidden"),Craft.postActionRequest("videos/getVideos",data,$.proxy(function(e,t){this.deselectVideos(),this.$spinner.addClass("hidden"),this.$videos.html(""),"success"==t&&("undefined"==typeof e.error?(this.$videos.html(e.html),this.$playBtns=$(".play",this.$videos),this.$videoElements=$(".video",this.$videos),this.addListener(this.$playBtns,"click","showPreview"),this.addListener(this.$videoElements,"click","selectVideo")):this.$videos.html('<p class="error">'+e.error+"</p>"))},this))},deselectVideos:function(){this.$videoElements&&(currentVideo=this.$videoElements.filter(".sel"),currentVideo.removeClass(".sel"),this.settings.onDeselectVideo())}});