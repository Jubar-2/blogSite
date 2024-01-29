<table class="table">
    <thead>
        <tr>
            <th scope="col">Full Name</th>
            <th scope="col">Contact</th>
            <th scope="col">Gender</th>
            <th scope="col">Birth Of Date</th>
            <th scope="col">Address</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $data) : ?>
            <tr>
                <th scope="row"><?= $data['fast_name'] . " " . $data['Last_name']; ?></th>
                <td><?= $data['email']; ?></td>
                <td><?= $data['gender']; ?></td>
                <td><?= $data['birthOfDate']; ?></td>
                <td><?= $data['district'] . " , " . $data['division'] . " , "  . $data['country']; ?></td>
            </tr>

        <?php endforeach ?>
    </tbody>
</table>