import { Container, Row } from "react-bootstrap";
import React from "react";

const LandingSection = ({
                            title = "Default Title",
                            body = "Default body content",
                            className = "",
                            children
                        }) => {
    return (
        <section className={`landing-bg d-flex align-items-center ${className}`}>
            <Container className="text-center text-light slide-down fade-in">
                <Row>
                    <div>
                        <h1 className="display-4 fw-bold">{title}</h1>
                        <p className="landing-text">{body}</p>
                        {children && <div className="mt-3">{children}</div>}
                    </div>
                </Row>
            </Container>
        </section>
    );
};

export default LandingSection;
