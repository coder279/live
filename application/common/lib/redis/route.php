<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


//企业网站首页界面
Route::rule('hkcis/index','company/Index/CompanyIndex','GET');
//*******************关于我们******************************************************************
//企业网站关于我们界面
Route::rule('hkcis/about','company/abouthkcis.AboutHkcis/abouthkcis','GET');
//企业网站关于团队
Route::rule('hkcis/aboutteam','company/abouthkcis.AboutAdminTeam/aboutteam','GET');
//企业网站企业架构
Route::rule('hkcis/aboutstruct','company/abouthkcis.AboutStruct/aboutstruct','GET');
//企业网站企业文化
Route::rule('hkcis/aboutculture','company/abouthkcis.AboutCulture/aboutculture','GET');
//*******************新闻动态******************************************************************
//企业网站行业关注
Route::rule('hkcis/newsaction','company/newshkcis.HkcisNewsAction/NewsAction','GET');
//企业网站公司动态
Route::rule('hkcis/professional','company/newshkcis.HkcisProfessional/professionalAction','GET');
//合规专栏
Route::rule('hkcis/cooper','company/newshkcis.HkcisCooper/professionalCooper','GET');
//行业研究
Route::rule('hkcis/study','company/newshkcis.HkcisStudy/professionalStudy','GET');
//新聞詳細
Route::rule('hkcis/news/detail','company/newshkcis.HkcisNewsAction/NewsDetail','GET');
Route::rule('hkcis/news/detaila','company/newshkcis.HkcisNewsAction/NewsDetaila','GET');
Route::rule('hkcis/news/detailb','company/newshkcis.HkcisNewsAction/NewsDetailb','GET');
Route::rule('hkcis/news/detailc','company/newshkcis.HkcisNewsAction/NewsDetailc','GET');
Route::rule('hkcis/news/detaild','company/newshkcis.HkcisNewsAction/NewsDetaild','GET');
//*******************产品介绍******************************************************************
//企业领域
Route::rule('hkcis/products','company/producthkcis.HkcisProduct/HkcisArea','GET');
//外汇
Route::rule('hkcis/foreign','company/producthkcis.HkcisForeign/Hkcisforeign','GET');
//指数
Route::rule('hkcis/code','company/producthkcis.HkcisCode/Hkciscode','GET');
//能源
Route::rule('hkcis/energy','company/producthkcis.HkcisEnergy/Hkcisenergy','GET');
//黄金
Route::rule('hkcis/gold','company/producthkcis.HkcisGold/Hkcisgold','GET');
//*******************服務案例******************************************************************
Route::rule('hkcis/service','company/servicehkcis.HkcisService/Hkcisservice','GET');
//*******************联系我们******************************************************************
Route::rule('hkcis/connect','company/connecthkcis.HkcisConnect/Hkcisconnect','GET');
//合作伙伴
Route::rule('hkcis/partner','company/connecthkcis.HkcisConnect/Hkcispartner','GET');











//客户注册
Route::rule('hkcis/customer/register','customer/Register/index','GET');
Route::rule('hkcis/customer/register','customer/Register/save','POST');
//客户登录
Route::rule('hkcis/customer/login','customer/Login/index','GET');
//客户登录信息处理
Route::rule('hkcis/customer/login','customer/Login/save','POST');
//退出登录
Route::rule('hkcis/customer/logout','customer/Login/logout','GET');

//客户管理
Route::rule('hkcis/customer/index','customer/Index/customerIndex','GET');
//用户资料->个人资料
Route::rule('hkcis/customer/personal','customer/PersonalForm/personal','GET');
//用户资料->银行信息
Route::rule('hkcis/customer/bank','customer/PersonalForm/bank','GET');
//资金管理->入金
Route::rule('hkcis/customer/input-wallet','customer/InputGold/ingold','GET');
//资金管理->出金
Route::rule('hkcis/customer/outgold','customer/OutGold/outgold','GET');
//投资周期
Route::rule('hkcis/customer/time','customer/StockTime/stocktime','GET');
//信号源
Route::rule('hkcis/customer/source','customer/Source/source','GET');
Route::rule('hkcis/customer/source/save','customer/Source/save','POST');
Route::rule('hkcis/customer/source/check','customer/Source/check','POST');












//+-----------------------------------------------------------------------------------------------------
Route::rule('index','index/Index/index','GET');
//注册界面ajax检测
Route::rule('check/checkphone','index/Check/checkphone','POST');
Route::rule('check/checkcode','index/Check/checkcode','POST');
Route::rule('check/check','index/Check/checkemail','POST');
//审核页面
Route::rule('between/:id','index/Between/between','GET');
		 
//我的账户
Route::rule('myaccount','index/Myaccount/index','GET');
//入金申请
Route::rule('Goldyield','index/Goldyield/index','GET'); 
//QR支付
Route::rule('qr','index/Qr/index','GET');
//人民币支付
Route::rule('rm','index/Rmb/index','GET');
//银行卡转账
Route::rule('repost','index/Repost/index','GET');
//出金申请
Route::rule('Deposit','index/Deposit/index','GET'); 
Route::rule('deposit','index/Deposit/save','POST');
Route::rule('success','index/Depositsuccess/index','GET');                    
//个人管理功能路由
Route::rule('admin','index/Admin/index','GET');
Route::rule('admin','index/Admin/save','POST');
//信号源路由
Route::rule('source','index/Source/index','GET');
//资金管理路由
Route::rule('money','index/Money/index','GET');
//软件下载路由
Route::rule('down','index/Down/index','GET');
//管理员后台管理
Route::rule('user/admin/confirm/adminsign','index/user.Adminsign/index','GET');
Route::rule('user/admin/confirm/adminsign','index/user.Adminsign/save','POST');
Route::rule('user/admin/confirm/adminsign/logout','index/user.Adminsign/logout','POST');
//管理员注册
Route::rule('user/admin/confirm/adminregister','index/user.Adminregister/index','GET');
//管理员后台
Route::rule('user/admin/confirm/administrator','index/user.Administrator/index','GET');
Route::rule('user/admin/confirm/administrator','index/user.Administrator/save','POST');
Route::rule('user/admin/confirm/admin','index/user.Add/index','GET');
//客户
Route::rule('user/admin/confirm/customer','index/user.Customer/lst','GET');
//管理员出入金
Route::rule('user/admin/confirm/customer/confirm','index/user.Online/x','GET');
//管理员审核列表
Route::rule('user/admin/confirm/edit','index/user.Edit/edit','GET');
Route::rule('user/admin/confirm/check','index/user.Check/check','POST');
//用户审核
Route::rule('user/admin/confirm/review','index/user.Review/review','GET');


//========================================================================================================================================
/*
 * 获取后台信号源数据
 */
Route::group('api',function(){
    //信号源数据接口
    Route::rule('listsource','admin_final/api.Source/getSourceApi','POST')->allowCrossDomain();
    Route::rule('addsource','admin_final/api.Source/addSourceApi','POST');
    Route::rule('editsource','admin_final/api.Source/editSourceApi','POST');
    Route::rule('deletesource','admin_final/api.Source/deleteSourceApi','POST');
    // 账户数据接口
    Route::rule('createaccount','admin_final/api.AccountController/createAccount','POST');
    Route::rule('listaccount','admin_final/api.AccountController/listAccount','GET');
    Route::rule('editaccount','admin_final/api.AccountController/editAccount','POST');
    Route::rule('detailaccount','admin_final/api.AccountController/detailAccount','POST');
    Route::rule('deleteaccount','admin_final/api.AccountController/deleteAccount','POST');

});
/**
 *  获取前台信号源数据
 */
Route::group('front',function(){
    //获取用户源数据
    Route::rule('getSource','admin_final/front.SourceController/getUserSource','POST');
    Route::rule('source/delete','admin_final/front.SourceController/deleteUserSource','POST');
    // 前台获取账户
    Route::rule('account','admin_final/front.AccountController/getUserAccount','POST');
    // 前台获取rank
    Route::rule('rank','admin_final/front.AccountController/getUserRank','GET');
    // 前台获取信号源数据
    Route::rule('getUserSource','admin_final/front.SourceController/confirmUserSource','POST');
    // 获取用户选择数据
    Route::rule('getTimeSource','admin_final/front.SourceController/getUserData','POST');
    // 获取用户输入金额数据
    Route::rule('getUserMoney','admin_final/front.MoneyController/getInputMoney','POST');
    // 获取用户数据
    Route::rule('getUserMoneyData','admin_final/front.MoneyController/getUserMoneyData','POST');
    // 删除用户数据
    Route::rule('deleteUserMoneyData','admin_final/front.MoneyController/deleteUserMoneyData','POST');
    // 获取用户上传文件
    Route::rule('upload','admin_final/front.TradeController/UploadImage','POST');
    // 获取用户平仓数据
    Route::rule('listmoney','admin_final/front.AccountController/getListMoney','GET');
    // 用户上传提佣信息
    Route::rule('putmoney','admin_final/front.AccountController/getUserTradeList','POST');

});
/**
 *  获取前台账户信息
 */
Route::rule('text','admin_final/api.GetExcel/outExcel','POST');

return [

];
