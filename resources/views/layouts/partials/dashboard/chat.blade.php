<div class="grid simple">
  <div class="grid-title">
    <h4><span class="label label-info"><i class="fa fa-info-circle"></i> Status: <span id="pusher-status"></span></span></h4>
    <ul class="nav nav-tabs" id="tabsChat">
      <li class="active"><a href="#showChat"><i class="fa fa-comments"></i> Chat </a></li>
      <li><a href="#showActiveUsers"><i class="fa fa-user-circle"></i> Aktywni użytkownicy <span class="badge badge-success">0</span> </a></li>
    </ul>
  </div>
  <div class="grid-body no-padding">
    <div class="tab-content no-margin">
      <div class="tab-pane active no-padding" id="showChat">
        <div class="chat">
          <div class="tiles white messages">
            @for ($x = 0; $x < 8; $x++)
              <div class="p-t-10 p-b-5 b-b b-grey">
                <div class="post">
                  <div class="user-profile-pic-wrapper">
                    <div class="user-profile-pic-2x white-border">
                      <img width="45" height="45" src="https://scontent-fra3-1.xx.fbcdn.net/v/t1.0-1/c0.0.160.160/p160x160/14317356_935187816626851_1587266056910082644_n.jpg?oh=e8f6ebb015f8fdf1fc288a0acb95f2c5&oe=58C45DB8" alt="">
                    </div>
                  </div>
                  <div class="info-wrapper small-width inline">
                    <div class="info">
                      <p><span class="username">{{ Auth::user()->username }}:</span>mógłbym jakiś kontakt do programisty kingprize?</p>
                      <p class="muted small-text"> 2 minuty temu </p>
                    </div>
                  <div class="clearfix"></div>
                  </div>
                <div class="clearfix"></div>
                </div>
              </div>
            @endfor
          </div>
          <div class="tiles new-message">
            <form action="" id="chat_send" method="post">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Treść wiadomości..." name="chat_shout_msg">
                  <span class="input-group-btn">
                    <input class="btn btn-success" type="submit" name="chat_shout">
                  </span>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="tab-pane no-padding" id="showActiveUsers">
      @if (count($onlineUsers) === 0)
          Brak użytkowników online!
          @else
          @foreach ($onlineUsers as $user)
            {{ $user->username }}
      @endforeach
      @endif
      </div>
    </div>
  </div>
</div>