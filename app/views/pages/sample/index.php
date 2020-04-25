<?= $this::add_template('header') ?>

<h6 class="text-center">Here are sample to all components</h6>

<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0">Buttons</h6>
        </div>
        <div class="card-content">
            <span>Normal Buttons</span>
            <div class="display-grid grid-col-4 grid-g-1 mb-1">
                <button class="btn">default</button>
                <button class="btn btn-primary">primary</button>
                <button class="btn btn-secondary">secondary</button>
                <button class="btn btn-success">success</button>
                <button class="btn btn-warning">warning</button>
                <button class="btn btn-danger">danger</button>
                <button class="btn btn-info">info</button>
                <button class="btn btn-dark">dark</button>
            </div>
            
            <span>Large Buttons</span>
            <div class="display-grid grid-col-4 grid-g-1">
                <button class="btn btn-lg">default</button>
                <button class="btn btn-lg btn-primary">primary</button>
                <button class="btn btn-lg btn-secondary">secondary</button>
                <button class="btn btn-lg btn-success">success</button>
                <button class="btn btn-lg btn-warning">warning</button>
                <button class="btn btn-lg btn-danger">danger</button>
                <button class="btn btn-lg btn-info">info</button>
                <button class="btn btn-lg btn-dark">dark</button>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0">Headings</h6>
        </div>
        <div class="card-content">
            <h1>Heading 1</h1>
            <h2>Heading 2</h2>
            <h3>Heading 3</h3>
            <h4>Heading 4</h4>
            <h5>Heading 5</h5>
            <h6>Heading 6</h6>
        </div>
    </div>
</div>

<?= $this::add_template('footer') ?>