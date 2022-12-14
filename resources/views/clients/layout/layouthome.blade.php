
@extends('clients.layout.clientlayout')
@section('css')
<style>
    *{
        margin: 0;
        padding: 0;
        font-family: "Roboto Slab", Cambria, Georgia, "Times New Roman", Times, serif;
    }

    .container{
        min-width: 980px;
        max-width: 1200px;
        margin: 0 auto;
        padding-top: 10px;
    }
    /* duong dan chi tiet trang */
    main .breadcrumbs {
            display: flex;
            grid-gap: 6px;
        }
    main .breadcrumbs li,
    main .breadcrumbs li a {
        font-size: 17px;
        list-style-type: none;
    }
    main .breadcrumbs li a.home{
        font-weight: 800;
    }
    main .breadcrumbs li a {
        color: #085F63;
        text-decoration: none;
    }
    main .breadcrumbs li a.active,
    main .breadcrumbs li.divider {
        color: rgb(51, 49, 49);
        pointer-events: none;
        list-style-type: none;
    }
    /*silebar */
    img.logo{
    width: 80px;
    height: 100px;
    float: left;
    }
    .title{
    float: left;
    text-align: center;
    padding-top: 15px;
    padding-left: 10px;

    }
    a img.nen{
    width:290px;
    height:160px;
    float:right;
    padding-top: 0;
    border-radius: 10px 0px 0px 150px;

    border: 1px solid white;

    }

    img.nen{
    /* border-radius: 20px 0px 0px 30px; */
    }
    header{
    height: 160px;
    background: rgb(247, 244, 244);
    background-image: url("https://www.hinhnenemail.com/files/elegant-simple/18/top.jpg");

    }

    header img {
    padding-left: 20px;
    padding-top: 5px;
    }

    footer{
    min-width: 980px;
    max-width: 1200px;
    height: 80px;
    background: #82ccdd;
    }
    .foo{
    text-align: center;
    }
    /*------------menu_-------------------*/
    /* *{
        padding: 0;
        margin: 0;
        font-family: "Roboto Slab", Cambria, Georgia, "Times New Roman", Times, serif;
    } */

    /* .menu-bar{
        margin-top: 10px;
        height: 60px;
    }

    ul{
        list-style: none;
        background: #82ccdd;
        padding-right: 10px;
    }

    ul li{
        display: inline-block;
        position:relative;
        font-size: 20px;
        text-align: center;
        padding-right: 20px;
    }

    ul li a {
        display: block;
        padding: 10px 20px;
        color: black;
        text-decoration: none;
        text-align: center;
        font-size: 20px;
    }

    ul li ul.dropdown li {
        display: block;
    }

    ul li ul.dropdown li a {
        width:100%;
    }

    ul li ul.dropdown {
        width: 100%;
        background: white;
        position: absolute;
        z-index: 999;
        border: 1px solid rgb(218, 212, 212);
        display: none;
        text-align: center;
    }

    ul li a:hover{
        background: #82ccdd;
    }

    ul li:hover ul.dropdown {
        display: block;
        width:100%;
    }
 */














    /* nav{
    height: 40px;
    background: rgb(48, 157, 220);
    }
    nav .menu ul{
    list-style: none;
    }
    nav .menu ul li{
    float: left;
    line-height: 40px;
    padding: 0 15px;
    }

    nav .menu ul li a{
    color: white;
    font-size: 12px;
    text-decoration: none;
    }

    nav .seach{
    line-height: 40px;
    float: right;
    margin-right: 25px;
    }

    ul li a.active{
    background-color: rgb(8, 8, 8);


    } */

    :root {
  --color-primary: #0073ff;
  --color-white: #e9e9e9;
  --color-black: #141d28;
  --color-black-1: #212b38;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}




.menu-bar {
  font-family: "Roboto Slab", Cambria, Georgia, "Times New Roman", Times, serif;
  background-color: #1B9CFC;
  height: 60px;
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 5%;

  margin-top: 10px;
  position: relative;
}

.menu-bar ul {
  list-style: none;
  display: flex;
  display: flex-start;

}

.menu-bar ul li {

  text-align: center;
  padding: 10px 30px;


  position: relative;
}

.menu-bar ul li a {
  font-size: 20px;
  color: rgb(254, 252, 252);
  text-decoration: none;

  transition: all 0.3s;
}

.dropdown-menu ul li a {
    color: black;
    text-align: center;
    border-bottom: 1px solid black;
}
.menu-bar ul li a:hover {
  color: var(--color-primary);
}

.fas {
  float: right;
  margin-left: 10px;
   padding-top: 3px;
}


.dropdown-menu {
  display: none;
}

.menu-bar ul li:hover .dropdown-menu {
  display: block;
  position: absolute;
  left: 0;
  top: 100%;
  background-color: white;
}

.menu-bar ul li:hover .dropdown-menu ul {
  display: block;
  margin: 10px;
}

.menu-bar ul li:hover .dropdown-menu ul li {
  width: 150px;
  padding: 10px;
}

.dropdown-menu-1 {
  display: none;
}

.dropdown-menu ul li:hover .dropdown-menu-1 {
  display: block;
  position: absolute;
  left: 150px;
  top: 0;
  background-color: white;
  color: black;
}
/* .hero {
  height: calc(100vh - 80px);
  background-image: url(./bg.jpg);
  background-position: center;
} */





    /* .menu{
    padding-top: 10px;
    }
    nav .menu ul li{
    float: left;
    }
    nav .user{
    float: right;
    margin-right: 25px;
    }
    ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #1B9CFC;
    }

    li {
    float: left;
    }

    li a, .dropbtn {
    font-family: 'Roboto Condensed', Arial, sans-serif;
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    }
    ul li a.active{
    background-color: blue;
    }
    li a:hover, .dropdownn:hover .dropbtn {
    background-color: rgb(46, 8, 239);
    }

    li.dropdownn {
    display: inline-block;
    }

    .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    }

    .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
    }

    .dropdown-content a:hover {
    background-color: #0099cc;
    color: white;
    }

    .dropdown:hover .dropdown-content {
    display: block;
    }

    .search-box{
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    background: red;
    height: 40px;
    border-radius: 40px;
    padding: 10px;
    }
    .search-btn{
    color: #1B9CFC;
    float: right;
    width: 40px;
    height: 40px;
    border-radius: 40px;
    background: #8cc130;
    display: flex;
    justify-content: center;
    align-items: center;
    }
    .search-txt{
    border: none;
    background: none;
    outline: none;
    float:left;
    padding: 0;
    color: rgb(200, 30, 157);
    font-size: 16px;
    transition: 0.4s;
    line-height: 40px;
    width: 0px;

    }

    .user{
    border-radius: 60px;
    background: #1B9CFC;
    width: 0;
    float: right;
    padding-top: 15px;
    color: #1B9CFC;
    float: right;

    display: flex;
    justify-content: center;
    align-items: center;
    }
    .dn{

    color:white;
    }
    .dn:hover {
    color: black;
    } */
    /*----------body----------*/
    .main{
    padding:20px 0px;
    }

    .main .right{
    width: 80%;
    border: 1px solid rgb(173, 171, 171);
    min-width: 40%;
    }

    .main .left{
    width: 20%;
    background-color: antiquewhite;
    border: 1px solid rgb(173, 171, 171);
    min-width: 40%;
    }

    .column {
    float: left;
    padding: 10px;
    }

    /* Left and right column */
    .column.side {
    width: 20%;
    background-color: antiquewhite;
    border: 1px solid rgb(173, 171, 171);
    }

    /* Middle column */
    .column.middle {
    width: 75%;
    border: 1px solid rgb(173, 171, 171);
    }

    /* Clear floats after the columns */
    .row:after {
    content: "";
    display: table;
    clear: both;
    }
    @media screen and (max-width: 980px) {
    .column.side, .column.middle {
    width: 100%;
    }
    }

    .column.side .tb{
    text-align: center;
    font-style: 20px;
    height: 20px;
    background: rgb(32, 199, 221);
    color: white;width: 100%;
    }
    .tb{
    width: 200px;
    padding-right: 10px;
    float: right;
    height: 30px;
    text-align: center;
    background: blue;
    color: white;
    margin-right: 5px;
    }
    /*tong diem va xep loai -chuc nang xem diem*/
    #tdxl p.tdtd {
        padding-right: 10px;
        font-size: 18px;
    }
    #tdxl p.tdtd .tdiem{
        color: #FF0DE5;
    }
    #tdxl p.iconxl {
        padding-right: 10px;
        font-size: 18px;
    }
    #tdxl p.tdxl {
        font-size: 18px;
    }
    #tdxl p.xl b{
        font-size: 18px;
        color: red;
    }
</style>
@endsection

