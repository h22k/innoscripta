import classNames from 'classnames';

export default function AppSection({ children, className }){

    const finalClasses = classNames('m-6', className)

    return(
        <section className={finalClasses}>
            {children}
        </section>
    );
}
