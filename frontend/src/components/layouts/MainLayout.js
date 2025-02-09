import NavBar from './navbar/NavBar';
import { Outlet } from 'react-router-dom';
import Footer from './footer/Footer';

const MainLayout = () => {
    return (
        <>
            <NavBar />
            <div className={'content'}>
                <Outlet />
            </div>
            <Footer />
        </>
    );
};

export default MainLayout;