<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
    <link rel="stylesheet" href="vendor/twitter/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<div class="container">
    <form class="form-horizontal" role="form" id="registration-form" action="" method="post">
        <div class="notices" id="notices"></div>
        <fieldset class="form-group">
            <label for="email" class="col-sm-3 ">Email</label>
            <div class="col-sm-9">
                <input type="email" id="email" name="email" placeholder="Email" class="form-control">
            </div>
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-sm-3 ">Password</label>
            <div class="col-sm-9">
                <input type="password" id="password" name="password" placeholder="Password" class="form-control">
            </div>
        </fieldset>
        <fieldset class="form-group">
            <label for="birth-date" class="col-sm-3 ">Date of Birth</label>
            <div class="col-sm-9">
                <input type="date" id="birth-date" name="birth-date" class="form-control">
            </div>
        </fieldset>
        <fieldset class="form-group">
            <legend>Gender</legend>
            <div class="form-check">
                <input type="radio" id="female" name="gender" value="Female">
                <label class="form-check-label" for="female">Female</label>
            </div>
            <div class="form-check">
                <input type="radio" id="male" name="gender" value="Male">
                <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check">
                <input type="radio" id="other" name="gender" value="Other">
                <label class="form-check-label" for="other">Other</label>
            </div>
        </fieldset>
        <fieldset class="form-group">
            <label for="discipline" class="col-sm-3 ">Discipline</label>
            <div class="col-sm-9">
                <select id="discipline" name="discipline" class="form-control">
                    <option value="">--Select--</option>
                    <option value="Music" data-set="discipline-music">Music</option>
                    <option value="Dance" data-set="discipline-dance">Dance</option>
                    <option value="Theater">Theater</option>
                    <option value="Visual Arts">Visual Arts</option>
                    <option value="Literature">Literature</option>
                    <option value="Film/Video">Film/Video</option>
                </select>
            </div>
        </fieldset>
        <fieldset class="form-group hidden-field" data-set="discipline-music">
            <label for="discipline-music" class="col-sm-3 ">Discipline style for Music</label>
            <div class="col-sm-9">
                <select id="discipline-music" name="discipline-music" class="form-control">
                    <option value="">--Select--</option>
                    <option value="Jazz">Jazz</option>
                    <option value="Western classical">Western classical</option>
                    <option value="traditional/folkloric">traditional/folkloric</option>
                </select>
            </div>
        </fieldset>
        <fieldset class="form-group hidden-field" data-set="discipline-music">
            <label for="discipline-music-profession" class="col-sm-3 ">Discipline profession for Music</label>
            <div class="col-sm-9">
                <select id="discipline-music-profession" name="discipline-music-profession" class="form-control">
                    <option value="">--Select--</option>
                    <option value="Instrumentalist">Instrumentalist</option>
                    <option value="Vocalist">Vocalist</option>
                    <option value="Composer">Composer</option>
                    <option value="Songwriter">Songwriter</option>
                    <option value="Educator">Educator</option>
                </select>
            </div>
        </fieldset>
        <fieldset class="form-group hidden-field" data-set="discipline-dance">
            <label for="discipline-dance" class="col-sm-3 ">Discipline style for Dance</label>
            <div class="col-sm-9">
                <select id="discipline-dance" name="discipline-dance" class="form-control">
                    <option value="">--Select--</option>
                    <option value="Contemporary dance">Contemporary dance</option>
                    <option value="tap dance">tap dance</option>
                    <option value="Tango">Tango</option>
                    <option value="Songwriter">traditional/folklore</option>
                    <option value="World">World</option>
                </select>
            </div>
        </fieldset>
        <fieldset class="form-group hidden-field" data-set="discipline-dance">
            <label for="discipline-dance-profession" class="col-sm-3 ">Discipline profession for Dance</label>
            <div class="col-sm-9">
                <select id="discipline-dance-profession" name="discipline-dance-profession" class="form-control">
                    <option value="">--Select--</option>
                    <option value="Choreographer">Choreographer</option>
                    <option value="Performer">Performer</option>
                    <option value="Educator">Educator</option>
                </select>
            </div>
        </fieldset>

        <input class="btn btn-primary" type="submit" value="Submit">
    </form>
</div>
<script src="vendor/components/jquery/jquery.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>