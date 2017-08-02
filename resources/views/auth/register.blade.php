@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Register</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                        <label for="fname" class="col-md-4 control-label">First Name</label>

                        <div class="col-md-6">
                            <input id="fname" type="text" class="form-control" name="fname" value="{{ old('fname') }}" required autofocus>

                            @if ($errors->has('fname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
                        <label for="lname" class="col-md-4 control-label">Last Name</label>

                        <div class="col-md-6">
                            <input id="lname" type="text" class="form-control" name="lname" value="{{ old('lname') }}" required autofocus>

                            @if ($errors->has('lname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nlame') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="row">
                        <label for="consent" class="col-md-8 col-md-offset-2">Consent Form</label>
                    
                        <div class="col-md-8 col-md-offset-2">
                            <div style="height:200px;border:1px solid #ccc;padding-top:10px;padding-left:5px;padding-right:5px;padding-bottom:10px;font:14px;background-color:#f5f8fa;overflow:auto;">
                                <p><strong>
                                University of California, San Diego<br> 
                                Consent to Act as a Research Subject
                                </strong></p>

                                <p><strong>Title: Facilitating Decision-Making Through Technology</strong></p>

                                <p><strong><em>Who is conducting the study, why you have been asked to participate, how you were selected, and what is the approximate number of participants in the study?</em></strong><br>
                                Dr. Steven Dow, and Dr. Narges Mahyar are conducting a research study to find out more about group decision-making. You have been asked to participate in this study because you are at least 18 years old and you signed up voluntarily. There will be approximately 60 participants in this study.</p>

                                <p><strong><em>Why is this study being done?</em></strong><br>
                                The purpose of this study is to gain a better understanding of public engagement methods and how public can be part of decision-making processes related to their communities. We will conduct a series of studies to understand how social computing tools, such as CommunityCrit, can better facilitate feedback exchange and decision-making.</p>

                                <p><strong><em>What will happen to you in this study and which procedures are standard of care and which are experimental?</em></strong><br>
                                If you agree to be in this study, you will be asked to use an online tool, CommunityCrit, to provide feedback on alternative urban planning proposals.</p>

                                <p><strong><em>How much time will each study procedure take, what is your total time commitment, and how long will the study last?</em></strong><br>
                                This study will take around 30 minutes.</p>

                                <p><strong><em>What risks are associated with this study?</em></strong><br>
                                Participation in this study may involve some added risks or discomforts. These include the following: A potential for the loss of confidentiality; we will ensure that only the research team can access thevideo/audio recording and other data. All participants’ data will be erased after the research period. Research records will be kept confidential to the extent allowed by law. Research records may bereviewed by the UCSD Institutional Review Board. Because this is a research study, there may also be some unknown risks that are currently unforeseeable. You will be informed of any significant new findings.</p>

                                <p><strong><em>What are the alternatives to participating in this study?</em></strong><br>
                                The alternative to participation in this study is not to participate.</p>

                                <p><strong><em>What benefits can be reasonably expected?</em></strong><br>
                                There may or may not be any direct benefit to you from participating this study. Potential benefits forparticipants may also include getting information about new proposals and empowering them (especially those who cannot attend workshops and other face to face events) to voice their concerns through the online platforms. The investigator, may learn more about different methods to design an online tool for effective feedback exchange and get the feedback from our current design. Besides, society may benefit from this knowledge.</p>

                                <p><strong><em>Can you choose to not participate or withdraw from the study without penalty or loss of benefits?</em></strong><br>
                                Participation in research is entirely voluntary. You may refuse to participate or withdraw or refuse to participate in the online study or answer specific survey question at any time without penalty or loss of benefits to which you are entitled. You will be told if any important new information is found during the course of this study that may affect your wanting to continue.</p>

                                <p><strong><em>Can you be withdrawn from the study without your consent?</em></strong><br>
                                The PI may remove you from the study without your consent if the PI feels it is in your best interest or the best interest of the study. You may also be withdrawn from the study if you do not follow the instructions given you by the study personnel.</p>

                                <p><strong><em>Will you be compensated for participating in this study?</em></strong><br>
                                There is no compensation for participating in this study.</p>

                                <p><strong><em>Are there any costs associated with participating in this study?</em></strong><br>
                                There will be no cost to you for participating in this study.</p>

                                <p><strong><em>Who can you call if you have questions?</em></strong><br>
                                Dr. Steven Dow and/or Dr. Narges Mahyar has explained this study to you and answered your questions. If you have other questions or research-related problems, you may reach Dr. Steven Dow at spdow@ucsd.edu.</p>

                                <p>You may call the Human Research Protections Program Office at 858-246-HRPP (858-246-4777) to inquire about your rights as a research subject or to report research-related problems.</p>

                                <strong>Your Signature and Consent</strong><br>
                                You have received a copy of this consent document.<br>
                                By checking the box below, you agree to participate.
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" input id="consent" name="consent" required>
                                        I am 18 years of age or older, received the consent form, and consent to participate in this study.
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
