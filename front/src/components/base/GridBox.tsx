import classNames from 'classnames';

export default function GridBox({ className, children, ...rest }){
    const finalClasses = classNames('grid', className)

    return(
        <div className={finalClasses} {...rest}>
            {children}
        </div>
    );
}