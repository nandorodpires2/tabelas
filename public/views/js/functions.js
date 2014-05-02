/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function baseUrl() {
    var host = window.location.hostname;
    var base_url = "";

    if (host === 'localhost') {
        base_url = 'http://' + host + '/tabelas/public/';
    } else {
        base_url = 'http://' + host + '/public/';
    }
    
    return base_url;
}

