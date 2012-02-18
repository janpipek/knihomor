Ext.application({
    name: 'HelloExt',
    launch: function() {
        Ext.state.Manager.setProvider(Ext.create('Ext.state.CookieProvider'));

        Ext.define('Author',{
            extend: 'Ext.data.Model',
            fields: [
                { name: 'surname', type: 'string'},
                { name: 'firstname',  type: 'string'},
                { name: 'books', type: 'int'},
                {
                    name: 'author_id',
                    type: 'int'
                }
            ]
        });

        Ext.define('Book', {
           extend: 'Ext.data.Model',
           fields: [
              { 
                name: 'title',
                type: 'string'
              },
              {
                name: 'author',
                type: 'string'
              }
           ]
        });

        // create the Data Store
        var authorStore = Ext.create('Ext.data.Store', {
            model: 'Author',
            proxy: {
                type: 'ajax',
                url: './php/authors/list.php',
                reader: {
                    type: 'json',
                }
            }
        });

        var bookStore = Ext.create('Ext.data.Store', {
            model: 'Book',
            proxy: {
                type: 'ajax',
                url: './php/books/list.php',
                reader: {
                    type: 'json',
                }
            }
        });    

        var newAuthorWindow;
        var newAuthorForm;
        function showNewAuthorForm() {
            if (!newAuthorWindow) {
                newAuthorForm = Ext.create("Ext.form.Panel", {
                    defaultType: 'textfield',
                    width: "100%",
                    bodyPadding: 5,
                    url: 'php/authors/create.php',
                    layout: 'anchor',
                    items: [{
                        fieldLabel: 'First Name',
                        name: 'firstname',
                        allowBlank: true
                    },{
                        fieldLabel: 'Last Name',
                        name: 'surname',
                        allowBlank: false
                    }], 
                    buttons: [{
                        text: 'Reset',
                        handler: function() {
                            this.up('form').getForm().reset();
                        }
                    }, {
                        text: 'Submit',
                        formBind: true, //only enabled once the form is valid
                        disabled: true,
                        handler: function() {
                            var form = this.up('form').getForm();
                            if (form.isValid()) {
                                form.submit({
                                    success: function(form, action) {
                                       Ext.Msg.alert('Success', action.result.msg);
                                       authorStore.load();
                                       newAuthorWindow.close();
                                    },
                                    failure: function(form, action) {
                                        Ext.Msg.alert('Failed', action.result.msg);
                                    }
                                });
                            }
                        }
                    }],
                });

                newAuthorWindow = Ext.create('Ext.window.Window', {
                    title: 'Add Author',
                    closeAction: 'hide',
                    width: 400,
                    // height: 400,
                    // minHeight: 400,
                    layout: 'fit',
                    resizable: true,
                    modal: true,
                    items: newAuthorForm
                }); 
            }
            newAuthorForm.getForm().reset();
            newAuthorWindow.show();
        };

        if (!window.loggedIn)
        {
            window.loggedIn = false;
        }
        function showLoginForm() {
            var loginForm = Ext.create("Ext.form.Panel", {
                layout: 'anchor',
                url: 'php/login.php',
                bodyPadding: 5,
                defaultType: 'textfield',
                items: [{
                    fieldLabel: 'Login',

                    name: 'login'
                }, {
                    fieldLabel: 'Password',
                    inputType: 'password',
                    name: 'password'
                }],
                buttons: [{
                    text: "Log In",
                    handler: function() {
                        var form = this.up('form').getForm();
                        if (form.isValid()) {
                            form.submit({
                                success: function(form, action) {
                                    loginWindow.close();
                                    Ext.Msg.alert('Success', action.result.msg);
                                    userLabel.setText(action.result.user.login);
                                    onLogin();
                                },
                                failure : function(form, action) {
                                    Ext.Msg.alert('Failed', action.result.msg);
                                }
                            })
                        }
                    }
                }, {
                    text: "Continue as Guest",
                    handler: function() { loginWindow.close(); }
                }]
            });

            var loginWindow = Ext.create('Ext.window.Window', {
               title: 'Log In',
               width: 300,
               modal: true,
               layout: 'fit',
               resizable: true,
               items: loginForm
            });

            loginWindow.show();        
        }

        var newBookWindow;
        var newBookForm;
        function showNewBookForm(index) {
            if (!newBookWindow)
            {
                newBookForm = Ext.create("Ext.form.Panel", {
                    defaultType: 'textfield',
                    width: "100%",
                    bodyPadding: 5,
                    url: 'php/books/create.php',
                    layout: 'anchor',
                    items: [{
                        fieldLabel: 'Title',
                        name: 'title',
                        allowBlank: false
                    }, {
                        fieldLabel: 'Author',
                        xtype: 'combobox',
                        queryMode: 'local',
                        store: authorStore,
                        displayField: 'surname',
                        valueField: 'author_id',
                        forceSelection: true,
                        name: 'author',
                        allowBlank: false,
                        minChars: 2,
                        value: index,
                        readOnly: !!index,
                        typeAhead:true,
                        queryMode:'remote',

                    }],
                    buttons: [{
                        text: 'Reset',
                        handler: function() {
                            this.up('form').getForm().reset();
                        }                     
                    }, {
                        text: 'Submit',
                        formBind: true, //only enabled once the form is valid
                        disabled: true,
                        handler: function() {
                            var form = this.up('form').getForm();
                            if (form.isValid()) {
                                form.submit({
                                    success: function(form, action) {
                                       Ext.Msg.alert('Success', action.result.msg);
                                       authorStore.load();
                                       bookStore.load();
                                       newBookWindow.close();
                                    },
                                    failure: function(form, action) {
                                        Ext.Msg.alert('Failed', action.result.msg);
                                    }
                                });
                            }
                        }
                    }]
                });

                newBookWindow = Ext.create('Ext.window.Window', {
                    title: 'Add Book',
                    closeAction: 'hide',
                    width: 400,
                    // height: 400,
                    // minHeight: 400,
                    layout: 'fit',
                    resizable: true,
                    modal: true,
                    items: newBookForm
                });             
            };
            if (index) {
                newBookForm.getForm().setValues({"title": "", "author": index });
            } else {
                newBookForm.getForm().reset();
            }
            newBookWindow.show();
        }
          
        var addAuthorAction = Ext.create('Ext.Action', {
            // icon   : '../shared/icons/fam/delete.gif',  // Use a URL in the icon config
            text: 'Add Author',
            disabled: !window.loggedIn,
            // disabled: true,
            handler: function(widget, event) {
                showNewAuthorForm();
            }
        });

        var newBookAction = Ext.create('Ext.Action', { 
            text: 'New Book',
            disabled: !window.loggedIn,
            handler: function(widget, event) {
                showNewBookForm();
            }
        }); 

        var addBookAction = Ext.create('Ext.Action', {
            text: 'Add Book',
            disabled: !window.loggedIn,
            handler: function(widget, event) {
                var rec = authorGrid.getSelectionModel().getSelection()[0];
                if (rec) {
                    showNewBookForm(rec.get('author_id'));
                } else {
                    alert('Wrong selection');
                }
            }
        });

        var authorContextMenu = Ext.create('Ext.menu.Menu', {
            items: [ addBookAction ]
        });

        var authorGrid = Ext.create('Ext.grid.Panel', {
            store: authorStore,
            stateful: true,
            stateId: 'stateAuthorGrid',
            columns: [
                {
                    text     : 'Surname',
                    sortable : true,
                    dataIndex: 'surname'
                },
                {
                    text     : 'First Name',
                    sortable : true,
                    dataIndex: 'firstname'
                },
                {
                    text     : 'Books',
                    sortable : true,
                    dataIndex: 'books'
                }
            ],
            dockedItems: [{
                xtype: 'toolbar',
                items: [
                    addAuthorAction
                ]
            }],              
            width: '100%',
            title: 'Authors',
            viewConfig: {
                stripeRows: true,
                listeners: {
                    itemcontextmenu: function(view, rec, node, index, e) {
                        e.stopEvent();
                        authorContextMenu.showAt(e.getXY());
                        return false;
                    }
                }
            }
        });

        // create the Grid
        var bookGrid = Ext.create('Ext.grid.Panel', {
            store: bookStore,
            stateful: true,
            stateId: 'stateBookGrid',
            columns: [
                {
                    text     : 'Title',
                    sortable : true,
                    dataIndex: 'title',
                    width: 200
                },
                {
                    text     : 'Author',
                    sortable: true,
                    dataIndex: 'author',
                    width: 150
                }
            ],   
            dockedItems: [{
                xtype: 'toolbar',
                items: [
                    newBookAction
                ]
            }],                    
            width: '100%',
            title: 'Books',
            viewConfig: {
                stripeRows: true
            }
        });  
        
        var panel = Ext.create('Ext.tab.Panel', {
            items: [
                authorGrid,
                bookGrid
            ],
            region: "center"
        });

        var logoutAction = Ext.create('Ext.Action', {
            // icon   : '../shared/icons/fam/delete.gif',  // Use a URL in the icon config
            text: 'Log Out',
            disabled: !window.loggedIn,
            // disabled: true,
            handler: function(widget, event) {
                Ext.Ajax.request({
                    url: 'php/logout.php',
                    success: function(form, action) {
                       Ext.Msg.alert('Success', "Successfully logged out.");
                       onLogout();
                    },
                    failure: function(form, action) {
                        Ext.Msg.alert('Failed', "Not logged out.");
                    }
                });
            }
        });


        var userLabel = Ext.create('Ext.toolbar.TextItem', {
            text: "Not logged in."
        })

        var statusBar = Ext.create('Ext.toolbar.Toolbar', {
            region: "south",
            items: [
                "User:",
                userLabel,
                logoutAction
            ]
        })   

        Ext.create('Ext.container.Viewport', {
            layout: 'border',
            // title: 'Library',
            renderTo: 'ext',
            items: [
                {
                    xtype: 'box',
                    id: 'header',
                    region: 'north',
                    html: '<h1 style="padding: 5px;font-size: 20px">Library</h1>',
                    // height: 30
                },
                panel,
                statusBar
            ]
        });

        function onLogin() {
            window.loggedIn = true;
            logoutAction.enable();
            addAuthorAction.enable();
            newBookAction.enable();
            addBookAction.enable();
        };

        function onLogout() {
            window.loggedIn = false;
            logoutAction.disable();
            addAuthorAction.disable();
            newBookAction.disable();
            addBookAction.disable();
        };
        
        authorStore.load();  
        bookStore.load();

        if (!window.loggedIn) {
            showLoginForm();
        }
    }
});