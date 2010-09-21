Ext.onReady(function(){

    Ext.QuickTips.init();

    // turn on validation errors beside the field globally
    Ext.form.Field.prototype.msgTarget = 'side';

    var bd = Ext.getBody();

    //bd.createChild({tag: 'h2', html: 'Form 2 - Adding fieldsets'});

    var fsf = new Ext.FormPanel({
        labelWidth: 75, // label settings here cascade unless overridden
        url:'',
        frame:true,
        title: 'Application Cache',
        bodyStyle:'padding:5px 5px 0',
        width: 350,

        items: [{
            xtype:'fieldset',
            title: 'APPLIACTION CACHE DATA CONFIGURATION',
            collapsible: false,
            autoHeight:true,
            defaults: {width: 210},
            defaultType: 'textfield',
            items :[
                new Ext.form.ComboBox({                        
                    fieldLabel: 'Language',
                    hiddenName:'lang',
                    store: new Ext.data.Store({
                        proxy: new Ext.data.HttpProxy({
                        	url: 'appCacheViewAjax',
                        	method:'POST'}
                        ),
                        baseParams:{
                    		request:'getLangList'
                    	},
                        reader: new Ext.data.JsonReader({
                        	root: 'rows',
	                        fields: [{name: 'LAN_ID'},{name: 'LAN_NAME'}] 
                        })
                    }),
                    valueField:'LAN_ID',
                    displayField:'LAN_NAME',
                    triggerAction: 'all',
                    emptyText:'Select',
                    selectOnFocus:true,
                    editable: false,
                    allowBlank: false,
                    allowBlankText: 'You should to select a language from the list.'
                })/*,
                {
                    fieldLabel: 'Business',
                    name: 'business'
                }*/
            ]
        }],

        buttons: [{
            text: 'Build Cache',
            disabled:false,
            handler: function(){
                fsf.getForm().submit({
                	url:'appCacheViewAjax?request=build&r='+Math.random(), 
                	waitMsg:'Building Cache for Application Data...',
                	timeout: 36000,
                	success: function(res,req)
                	{
    	            	/*Ext.MessageBox.show({
    	                    title: '',
    	                    msg: req.result.msg,
    	                    buttons: Ext.MessageBox.OK,
    	                    animEl: 'mb9',
    	                    fn: function(){},
    	                    icon: Ext.MessageBox.INFO
    	                });
    	            	setTimeout(function(){ Ext.MessageBox.hide(); }, 2000);*/
                		Ext.example.msg('', req.result.msg);
                		try{
                			Ext.fly(newEl).slideOut('t',{remove:true});
                		} catch(e){}
                	}
                });
            }
        }/*,{
            text: 'Cancel'
        }*/]
    });

    
    fsf.render(document.getElementById('main-panel')); //
    if( ! appCacheViewEnabled ){
      Warning();
    }
});

var newEl;
var Warning = function () {
    var tpl = new Ext.Template(
        '<div id="fb" style="border: 1px solid #FF0000; background-color:#FFAAAA; display:none; padding:15px; color:#000000;">',
    	'<b>Warning: </b>We detect that the Application Cache Data is not present in this Workspace environment, you need build it <a href="#" id="help1">Online Help</a></div>'
    );
    newEl = tpl.insertFirst('main-panel');

    /*Ext.fly('hideWarning').on('click', function() {
        Ext.fly(newEl).slideOut('t',{remove:true});
        cp.set('hideFBWarning', true);
    });*/
    Ext.fly(newEl).slideIn();
}



///

Ext.example = function(){
    var msgCt;

    function createBox(t, s){
        return ['<div class="msg">',
                '<div class="x-box-tl"><div class="x-box-tr"><div class="x-box-tc"></div></div></div>',
                '<div class="x-box-ml"><div class="x-box-mr"><div class="x-box-mc"><h3>', t, '</h3>', s, '</div></div></div>',
                '<div class="x-box-bl"><div class="x-box-br"><div class="x-box-bc"></div></div></div>',
                '</div>'].join('');
    }
    return {
        msg : function(title, format){
            if(!msgCt){
                msgCt = Ext.DomHelper.insertFirst(document.body, {id:'msg-div'}, true);
            }
            msgCt.alignTo(document, 't-t');
            var s = String.format.apply(String, Array.prototype.slice.call(arguments, 1));
            var m = Ext.DomHelper.append(msgCt, {html:createBox(title, s)}, true);
            m.slideIn('t').pause(1).ghost("t", {remove:true});
        },

        init : function(){
            var lb = Ext.get('lib-bar');
            if(lb){
                lb.show();
            }
        }
    };
}();

Ext.onReady(Ext.example.init, Ext.example);
