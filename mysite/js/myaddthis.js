$.getScript("//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-520714ca343e4410", successCallback);

addthis.layers({
  'share' : {
    'position' : 'right',
    'numPreferredServices' : 5,
    'desktop': false,
    'mobile': false
  }, 
  'follow' : {
    'desktop' : false,
    'mobile': false,
    'services' : [
      {'service': 'facebook', 'id': 'GalpinAutoSports'},
      {'service': 'twitter', 'id': 'galpinautosport'},
      //{'service': 'google_follow', 'id': 'galpinautosports'},
      {'service': 'instagram', 'id': 'galpinautosports'},
      {'service': 'youtube', 'id': 'galpinautosports'}
    ]
  }
});