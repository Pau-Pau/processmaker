/*
 * @author: Qennix
 * Feb 22nd, 2011
 */

//Keyboard Events
new Ext.KeyMap(document, [
{
  key: Ext.EventObject.F5,
  fn: function(keycode, e) {
    if (! e.ctrlKey) {
      if (Ext.isIE) {
        // IE6 doesn't allow cancellation of the F5 key, so trick it into
        // thinking some other key was pressed (backspace in this case)
        e.browserEvent.keyCode = 8;
      }
      e.stopEvent();
      document.location = document.location;
    }else{
      Ext.Msg.alert('Refresh', 'You clicked: CTRL-F5');
    }
  }
}
,
{
  key: Ext.EventObject.DELETE,
  fn: function(k,e){
    iGrid = Ext.getCmp('infoGrid');
    rowSelected = iGrid.getSelectionModel().getSelected();
    if (rowSelected){
      DeleteButtonAction();
    }
  }
},
{
  key: Ext.EventObject.F2,
  fn: function(k,e){
    iGrid = Ext.getCmp('infoGrid');
    rowSelected = iGrid.getSelectionModel().getSelected();
    if (rowSelected){
      EditCalendarAction();
    }
  }
}
]);

var store;
var cmodel;
var infoGrid;
var viewport;
var smodel;

var newButton;
var editButton;
var deleteButton;
var copyButton;
var searchButton;

var searchText;
var contextMenu;
var pageSize;

var classicSkin = '00000000000000000000000000000001';

Ext.onReady(function(){
  Ext.QuickTips.init();
  
  pageSize = parseInt(CONFIG.pageSize);
  
  newButton = new Ext.Action({
    text: _('ID_NEW'),
    iconCls: 'button_menu_ext ss_sprite  ss_add',
    disabled: true,
    handler: NewCalendarAction
  });
  
  editButton = new Ext.Action({
    text: _('ID_EDIT'),
    iconCls: 'button_menu_ext ss_sprite  ss_pencil',
    handler: EditCalendarAction,
    hidden: true,
    disabled: true	
  });
  
  deleteButton = new Ext.Action({
    text: _('ID_DELETE'),
    iconCls: 'button_menu_ext ss_sprite  ss_delete',
    handler: DeleteButtonAction,
    hidden: true,
    disabled: true
  });
  
  copyButton = new Ext.Action({
    text: _('ID_COPY'),
    iconCls: 'button_menu_ext ss_sprite ss_calendar_add',
    handler: CopyButtonAction,
    hidden: true,
    disabled: true
  });
  
  importButton = new Ext.Action({
    text: _('ID_IMPORT'),
    iconCls: 'button_menu_ext ss_sprite ss_basket_put',
    //handler: CopyButtonAction,
    disabled: true
  });
  exportButton = new Ext.Action({
    text: _('ID_EXPORT'),
    iconCls: 'button_menu_ext ss_sprite ss_basket_go',
    handler: exportSkin,
    disabled: true
  });
  searchButton = new Ext.Action({
    text: _('ID_SEARCH'),
    handler: DoSearch
  });
  
  contextMenu = new Ext.menu.Menu({
    items: [exportButton]
  });
  
  searchText = new Ext.form.TextField ({
    id: 'searchTxt',
    ctCls:'pm_search_text_field',
    allowBlank: true,
    width: 150,
    emptyText: _('ID_ENTER_SEARCH_TERM'),
    listeners: {
      specialkey: function(f,e){
        if (e.getKey() == e.ENTER) {
          DoSearch();
        }
      },
      focus: function(f,e) {
        var row = infoGrid.getSelectionModel().getSelected();
        infoGrid.getSelectionModel().deselectRow(infoGrid.getStore().indexOf(row));
      }
    }
  });
  
  clearTextButton = new Ext.Action({
    text: 'X',
    ctCls:'pm_search_x_button',
    handler: GridByDefault
  });
  
  
  smodel = new Ext.grid.RowSelectionModel({
    singleSelect: true,
    listeners:{
      rowselect: function(sm){
        rowSelected = infoGrid.getSelectionModel().getSelected();
        if((rowSelected.data.SKIN_FOLDER_ID)&&((rowSelected.data.SKIN_FOLDER_ID!="classic"))){
          exportButton.enable();
        }else{
          exportButton.disable();
        }
      },
      rowdeselect: function(sm){
        exportButton.disable();
      }
    }
  });
  
  store = new Ext.data.GroupingStore( {
    proxy : new Ext.data.HttpProxy({
      url: 'skin_Ajax?action=skinList'
    }),
    reader : new Ext.data.JsonReader( {
      root: 'skins',
      totalProperty: 'total_skins',
      fields : [
      {
        name : 'SKIN_ID'
      },

      {
        name : 'SKIN_FOLDER_ID'
      },

      {
        name : 'SKIN_NAME'
      },

      {
        name : 'SKIN_DESCRIPTION'
      },

      {
        name : 'SKIN_AUTHOR'
      },

      {
        name : 'SKIN_CREATEDATE'
      },

      {
        name : 'SKIN_MODIFIEDDATE'
      },

      {
        name : 'SKIN_STATUS'
      }
      ]
    })
  });
  
  cmodel = new Ext.grid.ColumnModel({
    defaults: {
      width: 50,
      sortable: true
    },
    columns: [
    {
      id:'SKIN_UID',
      dataIndex: 'SKIN_UID',
      hidden:true,
      hideable:false
    },

    {
      header: _('ID_NAME'),
      dataIndex: 'SKIN_NAME',
      width: 80,
      align:'left'
    },

    {
      header: _('ID_DESCRIPTION'),
      dataIndex: 'SKIN_DESCRIPTION',
      width: 200,
      align:'left'
    },

    {
      header: _('ID_AUTHOR'),
      dataIndex: 'SKIN_AUTHOR',
      width: 80,
      align:'left'
    },

    {
      header: _('ID_CREATE'),
      dataIndex: 'SKIN_CREATEDATE',
      width: 50,
      align:'center',
      renderer: showdate
    },

    {
      header: _('ID_UPDATE_DATE'),
      dataIndex: 'SKIN_MODIFIEDDATE',
      width: 50,
      align:'center',
      renderer: showdate
    }
    //{header: _('ID_STATUS'), dataIndex: 'SKIN_STATUS', width: 130, align:'center', renderer: render_status},
    ]
  });
  
  storePageSize = new Ext.data.SimpleStore({
    fields: ['size'],
    data: [['20'],['30'],['40'],['50'],['100']],
    autoLoad: true
  });
  
  comboPageSize = new Ext.form.ComboBox({
    typeAhead     : false,
    mode          : 'local',
    triggerAction : 'all',
    store: storePageSize,
    valueField: 'size',
    displayField: 'size',
    width: 50,
    editable: false,
    listeners:{
      select: function(c,d,i){
        UpdatePageConfig(d.data['size']);
        bbarpaging.pageSize = parseInt(d.data['size']);
        bbarpaging.moveFirst();
      }
    }
  });
  
  comboPageSize.setValue(pageSize);
  
  bbarpaging = new Ext.PagingToolbar({
    pageSize: pageSize,
    store: store,
    displayInfo: true,
    displayMsg: _('ID_GRID_PAGE_DISPLAYING_SKIN_MESSAGE') + '&nbsp; &nbsp; ',
    emptyMsg: _('ID_GRID_PAGE_NO_SKIN_MESSAGE')//,
  //items: ['-',_('ID_PAGE_SIZE')+':',comboPageSize]
  });
  
  
  infoGrid = new Ext.grid.GridPanel({
    region: 'center',
    layout: 'fit',
    id: 'infoGrid',
    height:100,
    autoWidth : true,
    stateful : true,
    stateId : 'grid',
    enableColumnResize: true,
    enableHdMenu: true,
    frame:false,
    //iconCls:'icon-grid',
    columnLines: false,
    viewConfig: {
      forceFit:true
    },
    title : _('ID_SKINS'),
    store: store,
    cm: cmodel,
    sm: smodel,
    tbar: [newButton, '-', importButton,exportButton, {
      xtype: 'tbfill'
    }, searchText,clearTextButton,searchButton],
    bbar: bbarpaging,
    listeners: {
      rowdblclick: function(grid, n,e){
        rowSelected = infoGrid.getSelectionModel().getSelected();        
        if((rowSelected.data.SKIN_FOLDER_ID)&&((rowSelected.data.SKIN_FOLDER_ID!=""))){
          viewport.getEl().mask(_('ID_SKIN_SWITCHING'));
          changeSkin(rowSelected.data.SKIN_FOLDER_ID,SYS_SKIN);
        }
      }
    },
    view: new Ext.grid.GroupingView({
      forceFit:true,
      groupTextTpl: '{text}'
    })
  });
  
  infoGrid.on('rowcontextmenu', 
    function (grid, rowIndex, evt) {
      var sm = grid.getSelectionModel();
      sm.selectRow(rowIndex, sm.isSelected(rowIndex));
    },
    this
    );
  
  infoGrid.on('contextmenu', function(evt){
    evt.preventDefault();
  }, this);
  infoGrid.addListener('rowcontextmenu',onMessageContextMenu, this);
  infoGrid.store.load();
  
  viewport = new Ext.Viewport({
    layout: 'fit',
    autoScroll: false,
    items: [
    infoGrid
    ]
  });
});


//Function format dates
showdate = function (value){
  return _DF(value);
};

//Funtion Handles Context Menu Opening
onMessageContextMenu = function (grid, rowIndex, e) {
  e.stopEvent();
  var coords = e.getXY();
  contextMenu.showAt([coords[0], coords[1]]);
};

//Do Nothing Function
DoNothing = function(){};

exportSkin = function(){
  viewport.getEl().mask(_('ID_SKIN_EXPORTING'));
  rowSelected = infoGrid.getSelectionModel().getSelected();
  if((rowSelected.data.SKIN_FOLDER_ID)&&((rowSelected.data.SKIN_FOLDER_ID!="classic"))){
    Ext.Ajax.request({
      url: 'skin_Ajax',
      params: {
        action: 'exportSkin',
        SKIN_FOLDER_ID: rowSelected.data.SKIN_FOLDER_ID
        },
      success: function(r,o){
        viewport.getEl().unmask();
        var resp = Ext.util.JSON.decode(r.responseText);
        if (resp.success){                    
          try {
            Ext.destroy(Ext.get('downloadIframe'));
          }
          catch(e) {}
          Ext.DomHelper.append(document.body, {
            tag: 'iframe',
            id:'downloadIframe',
            frameBorder: 0,
            width: 0,
            height: 0,
            css: 'display:none;visibility:hidden;height:0px;',
            src: 'skin_Ajax?action=streamSkin&file='+resp.message
          });
          viewport.getEl().unmask();
        }else{
          viewport.getEl().unmask();
          Ext.Msg.alert('Alert', resp.message);
        //PMExt.error(_('ID_SKINS'),_('ID_MSG_CANNOT_EXPORT_SKIN'));
        }
      },
      failure: function(r,o){
        viewport.getEl().unmask();
        PMExt.error(_('ID_SKINS'),_('ID_MSG_CANNOT_EXPORT_SKIN'));
      }
    });
  }else{
    PMExt.error(_('ID_SKINS'),_('ID_MSG_CANNOT_EXPORT_DEFAULT_SKIN'));
  }
}


//Open New Calendar
NewCalendarAction = function(){
  location.href = 'calendarEdit';
};

//Load Grid By Default
GridByDefault = function(){
  searchText.reset();
  infoGrid.store.load();
};

//Do Search Function
DoSearch = function(){
  infoGrid.store.load({
    params: {
      textFilter: searchText.getValue()
      }
    });
};

//Edit Calendar Action
EditCalendarAction = function(){
  rowSelected = infoGrid.getSelectionModel().getSelected();
  if (rowSelected){
    location.href = 'calendarEdit?id=' + rowSelected.data.CALENDAR_UID;
  }
};

//Delete Button Action
DeleteButtonAction = function(){
  rowSelected = infoGrid.getSelectionModel().getSelected();
  viewport.getEl().mask(_('ID_PROCESSING'));
  Ext.Ajax.request({
    url: 'calendar_Ajax',
    params: {
      action: 'canDeleteCalendar',
      CAL_UID: rowSelected.data.CALENDAR_UID
      },
    success: function(r,o){
      viewport.getEl().unmask();
      var resp = Ext.util.JSON.decode(r.responseText);
      if (resp.success){
        Ext.Msg.confirm(_('ID_CONFIRM'),_('ID_CONFIRM_DELETE_CALENDAR'),
          function(btn, text){
            if (btn=='yes'){
              viewport.getEl().mask(_('ID_PROCESSING'));
              Ext.Ajax.request({
                url: 'calendar_Ajax',
                params: {
                  action: 'deleteCalendar',
                  CAL_UID: rowSelected.data.CALENDAR_UID
                  },
                success: function(r,o){
                  viewport.getEl().unmask();
                  editButton.disable();
                  deleteButton.disable();
                  copyButton.disable();
                  DoSearch();
                  PMExt.notify(_('ID_CALENDARS'),_('ID_CALENDAR_SUCCESS_DELETE'));
                },
                failure: function(r,o){
                  viewport.getEl().unmask();
                }
              });
            }
          }
          );
      }else{
        PMExt.error(_('ID_CALENDARS'),_('ID_MSG_CANNOT_DELETE_CALENDAR')); 
      }	
    },
    failure: function(r,o){
      viewport.getEl().unmask();
    }
  });
};

//Render Status
render_status = function(v){
  switch(v){
    case 'ACTIVE':
      return '<font color="green">' + _('ID_ACTIVE') + '</font>';
      break;
    case 'INACTIVE':
      return '<font color="red">' + _('ID_INACTIVE') + '</font>';
      ;
      break;
    case 'VACATION':
      return '<font color="blue">' + _('ID_VACATION') + '</font>';
      ;
      break;
  }
};

//Members Button Action
CopyButtonAction = function(){
  rowSelected = infoGrid.getSelectionModel().getSelected();
  if (rowSelected){
    location.href = 'calendarEdit?cp=1&id=' + rowSelected.data.CALENDAR_UID;
  }
};

//Update Page Size Configuration
UpdatePageConfig = function(pageSize){
  Ext.Ajax.request({
    url: 'calendar_Ajax',
    params: {
      action:'updatePageSize',
      size: pageSize
    }
  });
};
function changeSkin(newSkin,currentSkin){
  currentLocation=top.location.href;
  newLocation = currentLocation.replace("/"+currentSkin+"/","/"+newSkin+"/");
  top.location.href=newLocation;
}