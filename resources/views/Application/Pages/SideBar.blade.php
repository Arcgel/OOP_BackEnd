<div class="sidebar-container">
    <ul>
        <li>
            <a href="">Dashboard</a>
        </li>
        <li>
            <a href="">Expenses</a>
        </li>
        <li>
            <a href="">Ingredient</a>
        </li>
        <li>
            <a href="">Invoce</a>
        </li>
        <li>
            <a href="">Products</a>
        </li>
        <li>
            <a href="">Sales</a>
        </li>
        <li>
            <form action="{{route('admin.logout')}}" method="post">
                @csrf
                <button type="submit" style="color:red;">Logout</button>
            </form>
        </li>
    </ul>
</div>