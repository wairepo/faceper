// function _req(vue_path, experiment_vue_path = null, experiment_name = null){
// 	// console.log('./../views/'+vue_path)
// 	// if(experiment_name && experiment_vue_path && window.store.state.experiments[experiment_name]){
// 	// 	return require('./../views/'+experiment_vue_path);
// 	// }else{
// 		return require('./../views/'+vue_path);
// 	// }
// }; 

// window._req = _req;


require('./_allroute.js');

router.addRoutes([
    { path: '*', redirect: { name: 'home' } },
]);
