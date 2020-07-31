<script src="/public/scripts/statistic.js"></script>
<h2>Hello, <?php /** @var $currentUserLogin */
    echo $currentUserLogin; ?></h2>
<form action="/homeLogout" method="POST">
    <button style="position: absolute; right: 20px;" id="logout" type="submit">log out</button>
</form>
<div style="display: flex; align-items: flex-start; margin-left: 600px;">
    <form method="post" action="/create">
        <button style="width: 500px;">Создать игру</button>
    </form>
    <button style="width: 250px;">Статистика</button>
</div>
<div style="display: flex; align-items: flex-start; margin-left: 600px; margin-top: 10px;">
    <div style=" width:250px;">
        <table>
            <p style=" text-align: center;">Мои игры</p>
            <?php /** @var $gamesForCurrentUser */
            foreach ($gamesForCurrentUser as $key => $row): ?>
                <tr>
                    <td><?php echo $row['first_id'] ?></td>
                    <td>
                        <form method="post" action="/gameJoin">

                            <?php
                            echo '<input type="hidden" name="id" value="' . $row['id'] . '" />' . "\n";
                            ?>

                            <button type="submit">Join</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div style="width: 250px;">
        <table>
            <p style="text-align: center;">Доступные игры</p>
            <?php /** @var $gamesForJoin */
            foreach ($gamesForJoin as $key => $row): ?>
                <tr>
                    <td><?php echo $row['first_id'] ?></td>
                    <td>
                        <form method="post" action="/gameJoin">

                            <?php
                            echo '<input type="hidden" name="id" value="' . $row['id'] . '" />' . "\n";
                            ?>

                            <button type="submit">Join</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div style="width: 250px">
        <p id="fullcount"></p>
        <p id="wins"></p>
        <p id="loses"></p>
        <p id="draws"></p>
    </div>
</div>
