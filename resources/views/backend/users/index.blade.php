    
@extends('backend.layout.app')

@section('content')

<!-- main page content body part -->
<div id="main-content">
    <div class="container-fluid">
        @if(session()->has('message'))
        <div class="alert alert-success" 
            style="position: absolute;
            z-index: 99999;
            top: 10%;
            left: 30%;
            width: 50%;">
        {{ session()->get('message') }}
        </div>
        @endif
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Project Board</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>                            
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item active">Project Board</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="d-flex flex-row-reverse">
                        <div class="page_action"> 
                            <a href="javascript:void(0);" data-toggle="modal"  class="btn btn-primary" data-target="#createmodal" ><i class="fa fa-add">أضف مستخدمًا</i></a>
                        </div>
                        <div class="p-2 d-flex">
                        </div>
                    </div>
                </div>
            </div>    
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2> العملاء</h2>
                        </div>
                        <div class="body project_report">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom mb-0">
                                    <thead>
                                        <tr>                                            
                                            <th>اسم المستخدم</th>
                                            <th> الهاتف</th>
                                            <th> -----</th>
                                            <th>البريد الالكتروني</th>
                                            <th> -----</th>
                                            <th> -----</th>
                                            <th>النوع</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                        <tr>
                                            <td class="project-title">
                                                <h6>{{$user->name}}</h6>
                                                <small>{{$user->first_name.' '}}{{$user->last_name}}</small>
                                            </td>
                                            <td  style="direction:ltr">{{$user->mobile}}</td>
                                            <td>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100" style="width: 48%;"></div>                                                
                                                </div>
                                                <small>Completion with: 48%</small>
                                            </td>
                                            <td>{{$user->email}}</td>
                                            <td><img src="assets/images/xs/avatar1.jpg" data-toggle="tooltip" data-placement="top" title="Team Lead" alt="Avatar" class="width35 rounded"></td>
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="assets/images/xs/avatar1.jpg" data-toggle="tooltip" data-placement="top" title="Avatar" alt="Avatar"></li>
                                                    <li><img src="assets/images/xs/avatar2.jpg" data-toggle="tooltip" data-placement="top" title="Avatar"></li>
                                                    <li><img src="assets/images/xs/avatar3.jpg" data-toggle="tooltip" data-placement="top" title="Avatar"></li>
                                                </ul>
                                            </td>
                                            <td>
                                                <span class="badge badge-success">
                                                    @if($user->role==4)
                                                    زبون عادي
                                                        @elseif   ($user->role==2) 
                                                            وكيل
                                                            @elseif   ($user->role==3)
                                                            صاحب محل
                                                            @else
                                                            مسؤول
                                                            @endif
                                                </span>
                                            </td>
                                            <td class="project-actions">
                                                <a href="#defaultModal" data-toggle="modal" data-target="#defaultModal">
                                                <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i class="icon-eye"></i></a>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#editModal{{$user->id}}" class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
                                                <a  href="javascript:void(0);" data-toggle="modal" data-target="#deleteModal{{$user->id}}" class="btn btn-sm btn-outline-danger" ><i class="icon-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-------------create--------->
<div class="modal fade" id="createmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel"></h4>
            </div>
            <div class="modal-body"> 
                <form method="Post"  action="{{ route('user.store') }}" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" required placeholder=" اسم المستخدم" aria-label="اسم المستخدم"  name ="name" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <select class="custom-select" required name="role" id="role">
                            <option selected value="2"> نوع العميل </option>
                            <option value="2">وكيل</option>
                            <option value="3">صاحب محل</option>
                            <option value="4">زبون عادي</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"></span>
                        </div>
                        <input type="text" class="form-control" required placeholder="الاسم الاول" aria-label="الاسم الأول" name="first_name" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"></span>
                        </div>
                        <input type="text" class="form-control" required placeholder=" الكنية" aria-label=" الكنية"name="last_name" -describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" required placeholder="البريد الالكتروني"  name="email" aria-label="البريد الالكتروني " aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">@example.com</span>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="input-group mb-3">
                            الجنس:
                            <label class="fancy-radio custom-color-green"><input name="gender3" value="ذكر`" type="radio" checked><span><i></i>Male</span></label>
                            <label class="fancy-radio custom-color-green"><input name="gender3" value="أنثى" type="radio"><span><i></i>Female</span></label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">تحميل</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" required>
                            <label class="custom-file-label" for="inputGroupFile01">اختر الصورة </label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"></span>
                        </div>
                        <input type="password" class="form-control" required placeholder=" كلمة السر" aria-label=" كلمة السر"name="password" -describedby="basic-addon1">
                    </div>
                
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <input type="text" class="form-control" required placeholder=" رقم الهاتف" aria-label=" رقم الهاتف"name="mobile" describedby="basic-addon1">
                        </div>                    
                          <select  class="custom-select" required  name="code" >
                            
                               <option value="">اختر البلد   </option>
                               <option value="+93">
                                 (+93) AFGHANISTAN</option>
                               <option value="+355">
                                 (+355) ALBANIA</option>
                               <option value="+213">
                                 (+213) ALGERIA</option>
                                <option value="+1684">
                                 (+1684) AMERICAN SAMOA</option>
                                <option value="+376">
                                 (+376) ANDORRA</option>
                                 <option value="+244">
                                 (+244) ANGOLA</option>
                                 <option value="+1264">
                                 (+1264) ANGUILLA</option>
                                  <option value="+0">
                                 (+0) ANTARCTICA</option>
                                  <option value="+1268">
                                 (+1268) ANTIGUA AND BARBUDA</option>
                                  <option value="+54">
                                 (+54) ARGENTINA</option>
                                   <option value="+374">
                                 (+374) ARMENIA</option>
                                  <option value="+297">
                                 (+297) ARUBA</option>
                                   <option value="+61">
                                 (+61) AUSTRALIA</option>
                                   <option value="+43">
                                 (+43) AUSTRIA</option>
                                 <option value="+994">
                                 (+994) AZERBAIJAN</option>
                                  <option value="+1242">
                                 (+1242) BAHAMAS</option>
                                   <option value="+973">
                                 (+973) BAHRAIN</option>
                                  <option value="+880">
                                 (+880) BANGLADESH</option>
                                  <option value="+1246">
                                 (+1246) BARBADOS</option>
                                   <option value="+375">
                                 (+375) BELARUS</option>
                                  <option value="+32">
                                 (+32) BELGIUM</option>
                                   <option value="+501">
                                 (+501) BELIZE</option>
                                  <option value="+229">
                                 (+229) BENIN</option>
                                  <option value="+1441">
                                 (+1441) BERMUDA</option>
                                  <option value="+975">
                                 (+975) BHUTAN</option>
                                  <option value="+591">
                                 (+591) BOLIVIA</option>
                                  <option value="+387">
                                 (+387) BOSNIA AND HERZEGOVINA</option>
                                   <option value="+267">
                                 (+267) BOTSWANA</option>
                                   <option value="+0">
                                 (+0) BOUVET ISLAND</option>
                                   <option value="+55">
                                 (+55) BRAZIL</option>
                                  <option value="+246">
                                 (+246) BRITISH INDIAN OCEAN TERRITORY</option>
                                                                       
                                 <option value="+673">
                                   (+673) BRUNEI DARUSSALAM</option>
                                   <option value="+359">
                                   (+359) BULGARIA</option>
                                   <option value="+226">
                                   (+226) BURKINA FASO</option>
                                   <option value="+257">
                                   (+257) BURUNDI</option>
                                   <option value="+855">
                                   (+855) CAMBODIA</option>
                                   <option value="+237">
                                    (+237) CAMEROON</option>
                                   <option value="+1">
                                     (+1) CANADA</option>
                                  <option value="+238">
                                 (+238) CAPE VERDE</option>
                                   <option value="+1345">
                                 (+1345) CAYMAN ISLANDS</option>
                                  <option value="+236">
                                 (+236) CENTRAL AFRICAN REPUBLIC</option>
                                   <option value="+235">
                                 (+235) CHAD</option>
                                 <option value="+56">
                                 (+56) CHILE</option>
                                                                                                                                                            
                                                                         <option value="+86">
                                 (+86) CHINA</option>
                                                                                                                                                            
                                                                         <option value="+61">
                                 (+61) CHRISTMAS ISLAND</option>
                                                                                                                                                            
                                                                         <option value="+672">
                                 (+672) COCOS (KEELING) ISLANDS</option>
                                                                                                                                                            
                                                                         <option value="+57">
                                 (+57) COLOMBIA</option>
                                                                                                                                                            
                                                                         <option value="+269">
                                 (+269) COMOROS</option>
                                                                                                                                                            
                                                                         <option value="+242">
                                 (+242) CONGO</option>
                                                                                                                                                            
                                                                         <option value="+242">
                                 (+242) CONGO, THE DEMOCRATIC REPUBLIC OF THE</option>
                                                                                                                                                            
                                                                         <option value="+682">
                                 (+682) COOK ISLANDS</option>
                                                                                                                                                            
                                                                         <option value="+506">
                                 (+506) COSTA RICA</option>
                                                                                                                                                            
                                                                         <option value="+225">
                                 (+225) COTE D'IVOIRE</option>
                                                                                                                                                            
                                                                         <option value="+385">
                                 (+385) CROATIA</option>
                                                                                                                                                            
                                                                         <option value="+53">
                                 (+53) CUBA</option>
                                                                                                                                                            
                                                                         <option value="+357">
                                 (+357) CYPRUS</option>
                                                                                                                                                            
                                                                         <option value="+420">
                                 (+420) CZECH REPUBLIC</option>
                                                                                                                                                            
                                                                         <option value="+45">
                                 (+45) DENMARK</option>
                                                                                                                                                            
                                                                         <option value="+253">
                                 (+253) DJIBOUTI</option>
                                                                                                                                                            
                                                                         <option value="+1767">
                                 (+1767) DOMINICA</option>
                                                                                                                                                            
                                                                         <option value="+1809">
                                 (+1809) DOMINICAN REPUBLIC</option>
                                                                                                                                                            
                                                                         <option value="+593">
                                 (+593) ECUADOR</option>
                                                                                                                                                            
                                                                         <option value="+20">
                                 (+20) EGYPT</option>
                                                                                                                                                            
                                                                         <option value="+503">
                                 (+503) EL SALVADOR</option>
                                                                                                                                                            
                                                                         <option value="+240">
                                 (+240) EQUATORIAL GUINEA</option>
                                                                                                                                                            
                                                                         <option value="+291">
                                 (+291) ERITREA</option>
                                                                                                                                                            
                                                                         <option value="+372">
                                 (+372) ESTONIA</option>
                                                                                                                                                            
                                                                         <option value="+251">
                                 (+251) ETHIOPIA</option>
                                                                                                                                                            
                                                                         <option value="+500">
                                 (+500) FALKLAND ISLANDS (MALVINAS)</option>
                                                                                                                                                            
                                                                         <option value="+298">
                                 (+298) FAROE ISLANDS</option>
                                                                                                                                                            
                                                                         <option value="+679">
                                 (+679) FIJI</option>
                                                                                                                                                            
                                                                         <option value="+358">
                                 (+358) FINLAND</option>
                                                                                                                                                            
                                                                         <option value="+33">
                                 (+33) FRANCE</option>
                                                                                                                                                            
                                                                         <option value="+594">
                                 (+594) FRENCH GUIANA</option>
                                                                                                                                                            
                                                                         <option value="+689">
                                 (+689) FRENCH POLYNESIA</option>
                                                                                                                                                            
                                                                         <option value="+0">
                                 (+0) FRENCH SOUTHERN TERRITORIES</option>
                                                                                                                                                            
                                                                         <option value="+241">
                                 (+241) GABON</option>
                                                                                                                                                            
                                                                         <option value="+220">
                                 (+220) GAMBIA</option>
                                                                                                                                                            
                                                                         <option value="+995">
                                 (+995) GEORGIA</option>
                                                                                                                                                            
                                                                         <option value="+49">
                                 (+49) GERMANY</option>
                                                                                                                                                            
                                                                         <option value="+233">
                                 (+233) GHANA</option>
                                                                                                                                                            
                                                                         <option value="+350">
                                 (+350) GIBRALTAR</option>
                                                                                                                                                            
                                                                         <option value="+30">
                                 (+30) GREECE</option>
                                                                                                                                                            
                                                                         <option value="+299">
                                 (+299) GREENLAND</option>
                                                                                                                                                            
                                                                         <option value="+1473">
                                 (+1473) GRENADA</option>
                                                                                                                                                            
                                                                         <option value="+590">
                                 (+590) GUADELOUPE</option>
                                                                                                                                                            
                                                                         <option value="+1671">
                                 (+1671) GUAM</option>
                                                                                                                                                            
                                                                         <option value="+502">
                                 (+502) GUATEMALA</option>
                                                                                                                                                            
                                                                         <option value="+224">
                                 (+224) GUINEA</option>
                                                                                                                                                            
                                                                         <option value="+245">
                                 (+245) GUINEA-BISSAU</option>
                                                                                                                                                            
                                                                         <option value="+592">
                                 (+592) GUYANA</option>
                                                                                                                                                            
                                                                         <option value="+509">
                                 (+509) HAITI</option>
                                                                                                                                                            
                                                                         <option value="+0">
                                 (+0) HEARD ISLAND AND MCDONALD ISLANDS</option>
                                                                                                                                                            
                                                                         <option value="+39">
                                 (+39) HOLY SEE (VATICAN CITY STATE)</option>
                                                                                                                                                            
                                                                         <option value="+504">
                                 (+504) HONDURAS</option>
                                                                                                                                                            
                                                                         <option value="+852">
                                 (+852) HONG KONG</option>
                                                                                                                                                            
                                                                         <option value="+36">
                                 (+36) HUNGARY</option>
                                                                                                                                                            
                                                                         <option value="+354">
                                 (+354) ICELAND</option>
                                                                                                                                                            
                                                                         <option value="+91">
                                 (+91) INDIA</option>
                                                                                                                                                            
                                                                         <option value="+62">
                                 (+62) INDONESIA</option>
                                                                                                                                                            
                                                                         <option value="+98">
                                 (+98) IRAN, ISLAMIC REPUBLIC OF</option>
                                                                                                                                                            
                                                                         <option value="+964">
                                 (+964) IRAQ</option>
                                                                                                                                                            
                                                                         <option value="+353">
                                 (+353) IRELAND</option>
                                                                                                                                                            
                                                                         <option value="+972">
                                 (+972) ISRAEL</option>
                                                                                                                                                            
                                                                         <option value="+39">
                                 (+39) ITALY</option>
                                                                                                                                                            
                                                                         <option value="+1876">
                                 (+1876) JAMAICA</option>
                                                                                                                                                            
                                                                         <option value="+81">
                                 (+81) JAPAN</option>
                                                                                                                                                            
                                                                         <option value="+962">
                                 (+962) JORDAN</option>
                                                                                                                                                            
                                                                         <option value="+7">
                                 (+7) KAZAKHSTAN</option>
                                                                                                                                                            
                                                                         <option value="+254">
                                 (+254) KENYA</option>
                                                                                                                                                            
                                                                         <option value="+686">
                                 (+686) KIRIBATI</option>
                                                                                                                                                            
                                                                         <option value="+850">
                                 (+850) KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF</option>
                                                                                                                                                            
                                                                         <option value="+82">
                                 (+82) KOREA, REPUBLIC OF</option>
                                                                                                                                                            
                                                                         <option value="+965">
                                 (+965) KUWAIT</option>
                                                                                                                                                            
                                                                         <option value="+996">
                                 (+996) KYRGYZSTAN</option>
                                                                                                                                                            
                                                                         <option value="+856">
                                 (+856) LAO PEOPLE'S DEMOCRATIC REPUBLIC</option>
                                                                                                                                                            
                                                                         <option value="+371">
                                 (+371) LATVIA</option>
                                                                                                                                                            
                                                                         <option value="+961">
                                 (+961) LEBANON</option>
                                                                                                                                                            
                                                                         <option value="+266">
                                 (+266) LESOTHO</option>
                                                                                                                                                            
                                                                         <option value="+231">
                                 (+231) LIBERIA</option>
                                                                                                                                                            
                                                                         <option value="+218">
                                 (+218) LIBYAN ARAB JAMAHIRIYA</option>
                                                                                                                                                            
                                                                         <option value="+423">
                                 (+423) LIECHTENSTEIN</option>
                                                                                                                                                            
                                                                         <option value="+370">
                                 (+370) LITHUANIA</option>
                                                                                                                                                            
                                                                         <option value="+352">
                                 (+352) LUXEMBOURG</option>
                                                                                                                                                            
                                                                         <option value="+853">
                                 (+853) MACAO</option>
                                                                                                                                                            
                                                                         <option value="+389">
                                 (+389) MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF</option>
                                                                                                                                                            
                                                                         <option value="+261">
                                 (+261) MADAGASCAR</option>
                                                                                                                                                            
                                                                         <option value="+265">
                                 (+265) MALAWI</option>
                                                                                                                                                            
                                                                         <option value="+60">
                                 (+60) MALAYSIA</option>
                                                                                                                                                            
                                                                         <option value="+960">
                                 (+960) MALDIVES</option>
                                                                                                                                                            
                                                                         <option value="+223">
                                 (+223) MALI</option>
                                                                                                                                                            
                                                                         <option value="+356">
                                 (+356) MALTA</option>
                                                                                                                                                            
                                                                         <option value="+692">
                                 (+692) MARSHALL ISLANDS</option>
                                                                                                                                                            
                                                                         <option value="+596">
                                 (+596) MARTINIQUE</option>
                                                                                                                                                            
                                                                         <option value="+222">
                                 (+222) MAURITANIA</option>
                                                                                                                                                            
                                                                         <option value="+230">
                                 (+230) MAURITIUS</option>
                                                                                                                                                            
                                                                         <option value="+269">
                                 (+269) MAYOTTE</option>
                                                                                                                                                            
                                                                         <option value="+52">
                                 (+52) MEXICO</option>
                                                                                                                                                            
                                                                         <option value="+691">
                                 (+691) MICRONESIA, FEDERATED STATES OF</option>
                                                                                                                                                            
                                                                         <option value="+373">
                                 (+373) MOLDOVA, REPUBLIC OF</option>
                                                                                                                                                            
                                                                         <option value="+377">
                                 (+377) MONACO</option>
                                                                                                                                                            
                                                                         <option value="+976">
                                 (+976) MONGOLIA</option>
                                                                                                                                                            
                                                                         <option value="+1664">
                                 (+1664) MONTSERRAT</option>
                                                                                                                                                            
                                                                         <option value="+212">
                                 (+212) MOROCCO</option>
                                                                                                                                                            
                                                                         <option value="+258">
                                 (+258) MOZAMBIQUE</option>
                                                                                                                                                            
                                                                         <option value="+95">
                                 (+95) MYANMAR</option>
                                                                                                                                                            
                                                                         <option value="+264">
                                 (+264) NAMIBIA</option>
                                                                                                                                                            
                                                                         <option value="+674">
                                 (+674) NAURU</option>
                                                                                                                                                            
                                                                         <option value="+977">
                                 (+977) NEPAL</option>
                                                                                                                                                            
                                                                         <option value="+31">
                                 (+31) NETHERLANDS</option>
                                                                                                                                                            
                                                                         <option value="+599">
                                 (+599) NETHERLANDS ANTILLES</option>
                                                                                                                                                            
                                                                         <option value="+687">
                                 (+687) NEW CALEDONIA</option>
                                                                                                                                                            
                                                                         <option value="+64">
                                 (+64) NEW ZEALAND</option>
                                                                                                                                                            
                                                                         <option value="+505">
                                 (+505) NICARAGUA</option>
                                                                                                                                                            
                                                                         <option value="+227">
                                 (+227) NIGER</option>
                                                                                                                                                            
                                                                         <option value="+234">
                                 (+234) NIGERIA</option>
                                                                                                                                                            
                                                                         <option value="+683">
                                 (+683) NIUE</option>
                                                                                                                                                            
                                                                         <option value="+672">
                                 (+672) NORFOLK ISLAND</option>
                                                                                                                                                            
                                                                         <option value="+1670">
                                 (+1670) NORTHERN MARIANA ISLANDS</option>
                                                                                                                                                            
                                                                         <option value="+47">
                                 (+47) NORWAY</option>
                                                                                                                                                            
                                                                         <option value="+968">
                                 (+968) OMAN</option>
                                                                                                                                                            
                                                                         <option value="+92">
                                 (+92) PAKISTAN</option>
                                                                                                                                                            
                                                                         <option value="+680">
                                 (+680) PALAU</option>
                                                                                                                                                            
                                                                         <option value="+970">
                                 (+970) PALESTINIAN TERRITORY, OCCUPIED</option>
                                                                                                                                                            
                                                                         <option value="+507">
                                 (+507) PANAMA</option>
                                                                                                                                                            
                                                                         <option value="+675">
                                 (+675) PAPUA NEW GUINEA</option>
                                                                                                                                                            
                                                                         <option value="+595">
                                 (+595) PARAGUAY</option>
                                                                                                                                                            
                                                                         <option value="+51">
                                 (+51) PERU</option>
                                                                                                                                                            
                                                                         <option value="+63">
                                 (+63) PHILIPPINES</option>
                                                                                                                                                            
                                                                         <option value="+0">
                                 (+0) PITCAIRN</option>
                                                                                                                                                            
                                                                         <option value="+48">
                                 (+48) POLAND</option>
                                                                                                                                                            
                                                                         <option value="+351">
                                 (+351) PORTUGAL</option>
                                                                                                                                                            
                                                                         <option value="+1787">
                                 (+1787) PUERTO RICO</option>
                                                                                                                                                            
                                                                         <option value="+974">
                                 (+974) QATAR</option>
                                                                                                                                                            
                                                                         <option value="+262">
                                 (+262) REUNION</option>
                                                                                                                                                            
                                                                         <option value="+40">
                                 (+40) ROMANIA</option>
                                                                                                                                                            
                                                                         <option value="+70">
                                 (+70) RUSSIAN FEDERATION</option>
                                                                                                                                                            
                                                                         <option value="+250">
                                 (+250) RWANDA</option>
                                                                                                                                                            
                                                                         <option value="+290">
                                 (+290) SAINT HELENA</option>
                                                                                                                                                            
                                                                         <option value="+1869">
                                 (+1869) SAINT KITTS AND NEVIS</option>
                                                                                                                                                            
                                                                         <option value="+1758">
                                 (+1758) SAINT LUCIA</option>
                                                                                                                                                            
                                                                         <option value="+508">
                                 (+508) SAINT PIERRE AND MIQUELON</option>
                                                                                                                                                            
                                                                         <option value="+1784">
                                 (+1784) SAINT VINCENT AND THE GRENADINES</option>
                                                                                                                                                            
                                                                         <option value="+684">
                                 (+684) SAMOA</option>
                                                                                                                                                            
                                                                         <option value="+378">
                                 (+378) SAN MARINO</option>
                                                                                                                                                            
                                                                         <option value="+239">
                                 (+239) SAO TOME AND PRINCIPE</option>
                                                                                                                                                            
                                                                         <option value="+966">
                                 (+966) SAUDI ARABIA</option>
                                                                                                                                                            
                                                                         <option value="+221">
                                 (+221) SENEGAL</option>
                                                                                                                                                            
                                                                         <option value="+381">
                                 (+381) SERBIA AND MONTENEGRO</option>
                                                                                                                                                            
                                                                         <option value="+248">
                                 (+248) SEYCHELLES</option>
                                                                                                                                                            
                                                                         <option value="+232">
                                 (+232) SIERRA LEONE</option>
                                                                                                                                                            
                                                                         <option value="+65">
                                 (+65) SINGAPORE</option>
                                                                                                                                                            
                                                                         <option value="+421">
                                 (+421) SLOVAKIA</option>
                                                                                                                                                            
                                                                         <option value="+386">
                                 (+386) SLOVENIA</option>
                                                                                                                                                            
                                                                         <option value="+677">
                                 (+677) SOLOMON ISLANDS</option>
                                                                                                                                                            
                                                                         <option value="+252">
                                 (+252) SOMALIA</option>
                                                                                                                                                            
                                                                         <option value="+27">
                                 (+27) SOUTH AFRICA</option>
                                                                                                                                                            
                                                                         <option value="+0">
                                 (+0) SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS</option>
                                                                                                                                                            
                                                                         <option value="+34">
                                 (+34) SPAIN</option>
                                                                                                                                                            
                                                                         <option value="+94">
                                 (+94) SRI LANKA</option>
                                                                                                                                                            
                                                                         <option value="+249">
                                 (+249) SUDAN</option>
                                                                                                                                                            
                                                                         <option value="+597">
                                 (+597) SURINAME</option>
                                                                                                                                                            
                                                                         <option value="+47">
                                 (+47) SVALBARD AND JAN MAYEN</option>
                                                                                                                                                            
                                                                         <option value="+268">
                                 (+268) SWAZILAND</option>
                                                                                                                                                            
                                                                         <option value="+46">
                                 (+46) SWEDEN</option>
                                                                                                                                                            
                                                                         <option value="+41">
                                 (+41) SWITZERLAND</option>
                                                                                                                                                            
                                                                         <option value="+963">
                                 (+963) SYRIAN</option>
                                                                                                                                                            
                                                                         <option value="+886">
                                 (+886) TAIWAN, PROVINCE OF CHINA</option>
                                                                                                                                                            
                                                                         <option value="+992">
                                 (+992) TAJIKISTAN</option>
                                                                                                                                                            
                                                                         <option value="+255">
                                 (+255) TANZANIA, UNITED REPUBLIC OF</option>
                                                                                                                                                            
                                                                         <option value="+66">
                                 (+66) THAILAND</option>
                                                                                                                                                            
                                                                         <option value="+670">
                                 (+670) TIMOR-LESTE</option>
                                                                                                                                                            
                                                                         <option value="+228">
                                 (+228) TOGO</option>
                                                                                                                                                            
                                                                         <option value="+690">
                                 (+690) TOKELAU</option>
                                                                                                                                                            
                                                                         <option value="+676">
                                 (+676) TONGA</option>
                                                                                                                                                            
                                                                         <option value="+1868">
                                 (+1868) TRINIDAD AND TOBAGO</option>
                                                                                                                                                            
                                                                         <option value="+216">
                                 (+216) TUNISIA</option>
                                                                                                                                                            
                                                                         <option value="+90">
                                 (+90) TURKEY</option>
                                                                                                                                                            
                                                                         <option value="+7370">
                                 (+7370) TURKMENISTAN</option>
                                                                                                                                                            
                                                                         <option value="+1649">
                                 (+1649) TURKS AND CAICOS ISLANDS</option>
                                                                                                                                                            
                                                                         <option value="+688">
                                 (+688) TUVALU</option>
                                                                                                                                                            
                                                                         <option value="+256">
                                 (+256) UGANDA</option>
                                                                                                                                                            
                                                                         <option value="+380">
                                 (+380) UKRAINE</option>
                                                                                                                                                            
                                                                         <option value="+971">
                                 (+971) UNITED ARAB EMIRATES</option>
                                                                                                                                                            
                                                                         <option value="+44">
                                 (+44) UNITED KINGDOM</option>
                                                                                                                                                            
                                                                         <option value="+1">
                                 (+1) UNITED STATES</option>
                                                                                                                                                            
                                                                         <option value="+1">
                                 (+1) UNITED STATES MINOR OUTLYING ISLANDS</option>
                                                                                                                                                            
                                                                         <option value="+598">
                                 (+598) URUGUAY</option>
                                                                                                                                                            
                                                                         <option value="+998">
                                 (+998) UZBEKISTAN</option>
                                                                                                                                                            
                                                                         <option value="+678">
                                 (+678) VANUATU</option>
                                                                                                                                                            
                                                                         <option value="+58">
                                 (+58) VENEZUELA</option>
                                                                                                                                                            
                                                                         <option value="+84">
                                 (+84) VIET NAM</option>
                                                                                                                                                            
                                                                         <option value="+1284">
                                 (+1284) VIRGIN ISLANDS, BRITISH</option>
                                                                                                                                                            
                                                                         <option value="+1340">
                                 (+1340) VIRGIN ISLANDS, U.S.</option>
                                                                                                                                                            
                                                                         <option value="+681">
                                 (+681) WALLIS AND FUTUNA</option>
                                                                                                                                                            
                                                                         <option value="+212">
                                 (+212) WESTERN SAHARA</option>
                                                                                                                                                            
                                                                         <option value="+967">
                                 (+967) YEMEN</option>
                                                                                                                                                            
                                                                         <option value="+260">
                                 (+260) ZAMBIA</option>
                                                                                                                                                            
                                                                         <option value="+263">
                                 (+263) ZIMBABWE</option>
                                                                                                                                                                                   
                          
                                  
                          </select>
                        
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="modal-footer">   
                        <button type="submit" class="btn btn-primary">حفظ</button>
                        <a href="#" class="btn btn-secondary">الغاء الأمر</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--------------delete -------------->
@foreach ($users as $key => $user)
<div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">
                    هل انت بالتاكيد تريد حذف العميل 
                    {{$user->name}}
                    ؟
                </h4>
            </div>
            <div class="modal-body"> 
              <form action="{{ route('user.destroy', $user->id) }}" method="POST">
               @csrf
               @method('DELETE')
               <input type="hidden" name="_token" value="{{ csrf_token() }}" />
               <div class="modal-footer">
                   <button type="submit" class="btn btn-primary">نعم</button>
                   <a href="#" class="btn btn-secondary">الغاء الأمر</a>
               </div>
              </form>
            
             </div>     
        </div>
    </div>
</div>
@endforeach


<!--------------edit -------------->
@foreach ($users as $key => $user)
<div class="modal fade" id="editModal{{$user->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel"> {{$user->name}}</h4>
            </div>
            <div class="modal-body"> 
                <form method="POST"  action="{{ route('user.update', ['user' => $user->id]) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" required placeholder=" اسم المستخدم"  value="{{$user->name}}" aria-label="اسم المستخدم"  name ="name" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <select class="custom-select" required name="role" id="role{{$user->id}}">
                            @if($user->role==2)
                            <option value="2" selected>وكيل</option>
                            @else
                            <option value="2" >وكيل</option>
                            @endif
                            @if($user->role==3)
                            <option value="3" selected>صاحب محل</option>
                            @else
                            <option value="3" >صاحب محل</option>
                            @endif
                            @if($user->role==4)
                            <option value="4" selected>زبون</option>
                            @else
                            <option value="4" >زبون</option>
                            @endif
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"></span>
                        </div>
                        <input type="text" class="form-control" value="{{$user->first_name}}" required placeholder="الاسم الاول"  aria-label="الاسم الأول" name="first_name" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"></span>
                        </div>
                        <input type="text" class="form-control" value="{{$user->last_name}}" required placeholder=" الكنية" aria-label=" الكنية"name="last_name" -describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control"value="{{$user->email}}" required placeholder="البريد الالكتروني"  name="email" aria-label="'البريد الالكتروني " aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">@example.com</span>
                        </div>
                    </div>
                 <div class="col-lg-6 col-md-12">
                    <div class="input-group mb-3">
                        الجنس:
                        <label class="fancy-radio custom-color-green"><input name="gender3" value="ذكر`" type="radio" checked><span><i></i>Male</span></label>
                        <label class="fancy-radio custom-color-green"><input name="gender3" value="أنثى" type="radio"><span><i></i>Female</span></label>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">تحميل</span>
                            </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image">
                            <label class="custom-file-label" for="inputGroupFile01">اختر الصورة </label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"></span>
                        </div>
                        <input type="password" value="{{$user->password}}" class="form-control" required placeholder=" كلمة السر" aria-label=" كلمة السر"name="password" -describedby="basic-addon1">
                    </div>
    
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                            <span class="input-group-text"></span>
                        </div>
                            <input type="text" class="form-control" style="direction:ltr" value="{{$user->mobile}}" required placeholder=" رقم الهاتف" aria-label=" رقم الهاتف"name="mobile" -describedby="basic-addon1">
                    
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="modal-footer"> 
                        <button type="submit" class="btn btn-primary">حفظ</button>
                        <a href="#" class="btn btn-secondary">الغاء الأمر</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


@endsection