import NavBar from './navbar/NavBar';
import { Outlet } from 'react-router-dom';

const MainLayout = () => {
    return (
        <>
            <NavBar />
            <div className={'content'}>
                <Outlet />
            </div>
        </>
    );
};

export default MainLayout;